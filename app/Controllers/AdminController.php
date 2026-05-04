<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BiodataModel;
use App\Models\SettingsModel;
use App\Models\PasswordResetModel;

class AdminController extends BaseController
{
    private function getUserId()
    {
        return session()->get('id');
    }

    public function index()
    {
        $userModel = new UserModel();
        $resetModel = new PasswordResetModel();
        $settingsModel = new SettingsModel();

        // Stats
        $totalPendaftar = $userModel->where('role', 'user')->countAllResults();
        $pendingVerifikasi = $userModel->where('role', 'user')->where('is_verified', false)->countAllResults();
        $menungguSeleksi = $userModel->where('status_pendaftaran', 'Menunggu Verifikasi')->countAllResults();
        $permintaanReset = $resetModel->where('token', 'pending')->countAllResults();

        // Chart.js Data (Daily registrations for the last 7 days)
        $db = \Config\Database::connect();
        // Fallback simple query for daily stats
        $query = $db->query("
            SELECT DATE(created_at) as tgl, COUNT(*) as jumlah 
            FROM users 
            WHERE role = 'user' AND created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at) ASC
        ");
        
        $chartData = $query->getResultArray();
        $labels = [];
        $data = [];
        
        foreach($chartData as $row) {
            $labels[] = $row['tgl'];
            $data[] = $row['jumlah'];
        }

        $viewData = [
            'title'             => 'Dashboard Administrator',
            'totalPendaftar'    => $totalPendaftar,
            'pendingVerifikasi' => $pendingVerifikasi,
            'menungguSeleksi'   => $menungguSeleksi,
            'permintaanReset'   => $permintaanReset,
            'settings'          => $settingsModel->first(),
            'chartLabels'       => json_encode($labels),
            'chartData'         => json_encode($data)
        ];

        return view('admin/dashboard', $viewData);
    }

    public function verifikasi()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, users.email, users.is_verified, users.created_at, biodata.nama_lengkap, biodata.no_identitas, biodata.jenis_identitas');
        $builder->join('biodata', 'biodata.user_id = users.id', 'left');
        $builder->where('users.role', 'user');
        // $builder->where('users.is_verified', false); // We might want to see all and just filter in DataTables

        $viewData = [
            'title'    => 'Verifikasi Akun Pendaftar',
            'pendaftar'=> $builder->get()->getResultArray()
        ];

        return view('admin/verifikasi', $viewData);
    }

    public function ubahVerifikasi()
    {
        $id = $this->request->getPost('id');
        $action = $this->request->getPost('action'); // 'approve' or 'reject'

        $userModel = new UserModel();
        if ($action === 'approve') {
            $userModel->update($id, ['is_verified' => true]);
            return redirect()->to('/admin/verifikasi')->with('success', 'Akun berhasil diverifikasi.');
        } else {
            // Optional: delete user if rejected, or just keep as unverified
            // $userModel->delete($id);
            return redirect()->to('/admin/verifikasi')->with('error', 'Akun ditolak.');
        }
    }

    public function seleksi()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, users.status_pendaftaran, biodata.nama_lengkap, akademik.asal_sekolah, akademik.total_nilai');
        $builder->join('biodata', 'biodata.user_id = users.id', 'left');
        $builder->join('akademik', 'akademik.user_id = users.id', 'left');
        $builder->where('users.role', 'user');
        $builder->whereIn('users.status_pendaftaran', ['Menunggu Verifikasi', 'Lolos Seleksi', 'Tidak Lolos']);

        $viewData = [
            'title'    => 'Seleksi Calon Siswa',
            'pendaftar'=> $builder->get()->getResultArray()
        ];

        return view('admin/seleksi', $viewData);
    }

    public function ubahSeleksi()
    {
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        $userModel = new UserModel();
        $userModel->update($id, ['status_pendaftaran' => $status]);

        return redirect()->to('/admin/seleksi')->with('success', 'Status seleksi berhasil diperbarui.');
    }

    public function rekap()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, biodata.nama_lengkap, biodata.no_identitas, akademik.asal_sekolah, akademik.total_nilai');
        $builder->join('biodata', 'biodata.user_id = users.id', 'left');
        $builder->join('akademik', 'akademik.user_id = users.id', 'left');
        $builder->where('users.status_pendaftaran', 'Lolos Seleksi');

        $viewData = [
            'title'    => 'Rekap Calon Siswa Lolos',
            'pendaftar'=> $builder->get()->getResultArray()
        ];

        return view('admin/rekap', $viewData);
    }

    public function downloadPdf()
    {
        if (!class_exists('\Dompdf\Dompdf')) {
            return redirect()->back()->with('error', 'Library Dompdf belum diinstal. Jalankan perintah composer require dompdf/dompdf di terminal Anda.');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('biodata.nama_lengkap, biodata.no_identitas, akademik.asal_sekolah, akademik.total_nilai');
        $builder->join('biodata', 'biodata.user_id = users.id', 'left');
        $builder->join('akademik', 'akademik.user_id = users.id', 'left');
        $builder->where('users.status_pendaftaran', 'Lolos Seleksi');
        
        $settings = (new SettingsModel())->first();

        $data = [
            'pendaftar' => $builder->get()->getResultArray(),
            'settings'  => $settings
        ];

        $html = view('admin/rekap_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Laporan_PPDB_Lolos_Seleksi.pdf", ["Attachment" => true]);
        exit;
    }

    public function pengaturan()
    {
        $settingsModel = new SettingsModel();
        
        $viewData = [
            'title'    => 'Pengaturan Sistem',
            'settings' => $settingsModel->first()
        ];

        return view('admin/pengaturan', $viewData);
    }

    public function updatePengaturan()
    {
        $settingsModel = new SettingsModel();
        $id = $this->request->getPost('id');

        $data = [
            'nama_sekolah'    => $this->request->getPost('nama_sekolah'),
            'tahun_pelajaran' => $this->request->getPost('tahun_pelajaran'),
            'tanggal_buka'    => $this->request->getPost('tanggal_buka'),
            'tanggal_tutup'   => $this->request->getPost('tanggal_tutup'),
        ];

        if ($id) {
            $settingsModel->update($id, $data);
        } else {
            $settingsModel->insert($data);
        }

        return redirect()->to('/admin/pengaturan')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function akun()
    {
        $userModel = new UserModel();
        $resetModel = new PasswordResetModel();

        $viewData = [
            'title'    => 'Manajemen Akun',
            'users'    => $userModel->findAll(),
            'resets'   => $resetModel->where('token', 'pending')->findAll()
        ];

        return view('admin/akun', $viewData);
    }

    public function ubahPasswordAdmin()
    {
        $rules = [
            'password_lama' => 'required',
            'password_baru' => 'required|min_length[6]',
            'konfirmasi'    => 'required|matches[password_baru]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Gagal merubah password, pastikan konfirmasi sesuai.');
        }

        $userId = $this->getUserId();
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (password_verify((string)$this->request->getPost('password_lama'), $user['password'])) {
            $userModel->update($userId, [
                'password' => password_hash((string)$this->request->getPost('password_baru'), PASSWORD_DEFAULT)
            ]);
            return redirect()->to('/admin/akun')->with('success', 'Password admin berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'Password lama salah.');
        }
    }

    public function resetPasswordUser()
    {
        $email = $this->request->getPost('email');
        $resetId = $this->request->getPost('reset_id');
        
        $userModel = new UserModel();
        $resetModel = new PasswordResetModel();

        $user = $userModel->where('email', $email)->first();
        if ($user) {
            // Reset to a default password or random
            $newPassword = 'password123'; 
            $userModel->update($user['id'], [
                'password' => password_hash($newPassword, PASSWORD_DEFAULT)
            ]);

            if ($resetId) {
                $resetModel->update($resetId, ['token' => 'resolved']);
            }

            return redirect()->to('/admin/akun')->with('success', 'Password user ' . $email . ' berhasil direset menjadi: ' . $newPassword);
        }

        return redirect()->to('/admin/akun')->with('error', 'User tidak ditemukan.');
    }

    public function deleteUser()
    {
        $id = $this->request->getPost('id');
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/akun')->with('error', 'User tidak ditemukan.');
        }

        // Barrier: Superadmin accounts cannot be deleted
        if ($user['role'] === 'superadmin') {
            return redirect()->to('/admin/akun')->with('error', 'Akses Ditolak: Akun Superadmin tidak boleh dihapus!');
        }

        // Prevent deleting own account
        if ((int)$user['id'] === (int)$this->getUserId()) {
            return redirect()->to('/admin/akun')->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Delete related data first (biodata, akademik, etc.)
        $db = \Config\Database::connect();
        $db->table('biodata')->where('user_id', $id)->delete();
        $db->table('orang_tua')->where('user_id', $id)->delete();
        $db->table('akademik')->where('user_id', $id)->delete();
        $db->table('prestasi')->where('user_id', $id)->delete();
        $db->table('berkas_pendukung')->where('user_id', $id)->delete();
        $db->table('password_resets')->where('email', $user['email'])->delete();

        $userModel->delete($id);

        return redirect()->to('/admin/akun')->with('success', 'Akun ' . esc($user['email']) . ' berhasil dihapus.');
    }

    public function updateProfilSuperadmin()
    {
        // Only superadmin can update their own profile via this method
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/akun')->with('error', 'Akses ditolak.');
        }

        $userId = $this->getUserId();

        $rules = [
            'username' => "required|min_length[3]|max_length[255]|is_unique[users.username,id,{$userId}]",
        ];

        // Password is optional — only validate if filled
        $passwordBaru = $this->request->getPost('password_baru');
        if (!empty($passwordBaru)) {
            $rules['password_baru'] = 'min_length[6]';
            $rules['konfirmasi_password'] = 'required|matches[password_baru]';
        }

        if (!$this->validate($rules)) {
            $errorMessages = implode(' ', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

        $userModel = new UserModel();
        $updateData = [
            'username' => $this->request->getPost('username'),
        ];

        if (!empty($passwordBaru)) {
            $updateData['password'] = password_hash((string)$passwordBaru, PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $updateData);

        // Update session username
        session()->set('username', $updateData['username']);

        $successMsg = 'Profil berhasil diperbarui.';
        if (!empty($passwordBaru)) {
            $successMsg .= ' Password juga telah diubah.';
        }

        return redirect()->to('/admin/akun')->with('success', $successMsg);
    }
}
