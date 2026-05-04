<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BiodataModel;
use App\Models\PasswordResetModel;

class AuthController extends BaseController
{
    public function login()
    {
        // If already logged in, redirect
        if (session()->get('isLoggedIn')) {
            $role = session()->get('role');
            return redirect()->to(in_array($role, ['admin', 'superadmin']) ? '/admin' : '/user/dashboard');
        }

        return view('auth/login');
    }

    public function processLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($user) {
            if (password_verify((string)$this->request->getPost('password'), $user['password'])) {
                // WAJIB session()->regenerate() setelah login sukses
                session()->regenerate();

                $sessionData = [
                    'id'          => $user['id'],
                    'email'       => $user['email'],
                    'username'    => $user['username'],
                    'role'        => $user['role'],
                    'is_verified' => $user['is_verified'],
                    'isLoggedIn'  => true
                ];
                session()->set($sessionData);

                if (in_array($user['role'], ['admin', 'superadmin'])) {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/user/dashboard');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email tidak ditemukan.');
        }
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'jenis_identitas' => 'required|in_list[KTP,KK]',
            'nama_lengkap'    => 'required|min_length[3]|max_length[255]',
            'no_identitas'    => 'required|is_unique[biodata.no_identitas]',
            'email'           => 'required|valid_email|is_unique[users.email]',
            'password'        => 'required|min_length[6]',
            'file_identitas'  => 'uploaded[file_identitas]|max_size[file_identitas,2048]|ext_in[file_identitas,png,jpg,jpeg,pdf]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $biodataModel = new BiodataModel();

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // 1. Insert User
            $username = explode('@', $this->request->getPost('email'))[0] . rand(100, 999);
            
            $userData = [
                'email'       => $this->request->getPost('email'),
                'username'    => $username,
                'password'    => password_hash((string)$this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'        => 'user',
                'is_verified' => false
            ];
            
            $userModel->insert($userData);
            $userId = $userModel->getInsertID();

            // 2. Upload File
            $fileIdentitas = $this->request->getFile('file_identitas');
            $fileName = $fileIdentitas->getRandomName();
            // Ensure upload directory exists
            $uploadPath = WRITEPATH . 'uploads/identitas';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $fileIdentitas->store('identitas/', $fileName);

            // 3. Insert Biodata
            $biodataData = [
                'user_id'         => $userId,
                'jenis_identitas' => $this->request->getPost('jenis_identitas'),
                'no_identitas'    => $this->request->getPost('no_identitas'),
                'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
                'file_identitas'  => $fileName
            ];

            $biodataModel->insert($biodataData);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->withInput()->with('error', 'Gagal mendaftar, terjadi kesalahan.');
            }

            return redirect()->to('/login')->with('success', 'Registrasi berhasil! Akun Anda sedang menunggu verifikasi admin.');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function forgotPassword()
    {
        return view('auth/forgot');
    }

    public function processForgotPassword()
    {
        $rules = [
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            $resetModel = new PasswordResetModel();
            $resetModel->insert([
                'email' => $email,
                'token' => 'pending' // Simpan permohonan reset untuk diproses admin
            ]);
            
            return redirect()->back()->with('success', 'Permohonan reset password berhasil dikirim. Silakan tunggu konfirmasi admin.');
        }

        // Even if email not found, we show success to prevent email enumeration attacks
        return redirect()->back()->with('success', 'Permohonan reset password berhasil dikirim. Silakan tunggu konfirmasi admin.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
