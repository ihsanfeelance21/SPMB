<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BiodataModel;
use App\Models\OrangTuaModel;
use App\Models\AkademikModel;
use App\Models\PrestasiModel;
use App\Models\BerkasPendukungModel;
use App\Models\SettingsModel;

class UserController extends BaseController
{
    private function getUserId()
    {
        return session()->get('id');
    }

    private function getProgress()
    {
        $userId = $this->getUserId();
        
        $biodata = (new BiodataModel())->where('user_id', $userId)->first();
        $orangTua = (new OrangTuaModel())->where('user_id', $userId)->first();
        $akademik = (new AkademikModel())->where('user_id', $userId)->first();
        $berkas = (new BerkasPendukungModel())->where('user_id', $userId)->first();
        
        $progress = 0;
        
        // Biodata is partially filled during registration. Check pas_foto to be considered "complete"
        if ($biodata && !empty($biodata['pas_foto'])) $progress += 25;
        if ($orangTua) $progress += 25;
        if ($akademik) $progress += 25;
        if ($berkas) $progress += 25;

        return $progress;
    }

    /**
     * Ensure upload directory exists before storing files.
     */
    private function ensureUploadDir(string $subDir): void
    {
        $path = WRITEPATH . 'uploads/' . trim($subDir, '/');
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    public function index()
    {
        $userId = $this->getUserId();
        $userModel = new UserModel();
        $settingsModel = new SettingsModel();

        $user = $userModel->find($userId);
        $settings = $settingsModel->first(); // Assuming row 1 exists

        $data = [
            'title'    => 'Dashboard Pendaftar',
            'user'     => $user,
            'progress' => $this->getProgress(),
            'settings' => $settings
        ];

        return view('user/dashboard', $data);
    }

    public function biodata()
    {
        $userId = $this->getUserId();
        $data = [
            'title'    => 'Data Diri & Orang Tua',
            'biodata'  => (new BiodataModel())->find($userId),
            'orangTua' => (new OrangTuaModel())->find($userId)
        ];
        return view('user/biodata', $data);
    }

    public function processBiodata()
    {
        $rules = [
            'nama_ayah'   => 'required',
            'nama_ibu'    => 'required',
            'pekerjaan'   => 'required',
            'penghasilan' => 'required',
            'no_telp'     => 'required|numeric'
        ];

        $pasFoto = $this->request->getFile('pas_foto');
        if ($pasFoto && $pasFoto->isValid() && !$pasFoto->hasMoved()) {
            $rules['pas_foto'] = 'uploaded[pas_foto]|max_size[pas_foto,2048]|ext_in[pas_foto,jpg,jpeg,png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = $this->getUserId();
        $biodataModel = new BiodataModel();
        $orangTuaModel = new OrangTuaModel();

        // Update pas foto if uploaded
        if ($pasFoto && $pasFoto->isValid()) {
            $this->ensureUploadDir('biodata');
            $fileName = $pasFoto->getRandomName();
            $pasFoto->store('biodata/', $fileName);
            $biodataModel->update($userId, ['pas_foto' => $fileName]);
        }

        // Save Orang Tua
        $orangTuaData = [
            'user_id'     => $userId,
            'nama_ayah'   => $this->request->getPost('nama_ayah'),
            'nama_ibu'    => $this->request->getPost('nama_ibu'),
            'pekerjaan'   => $this->request->getPost('pekerjaan'),
            'penghasilan' => $this->request->getPost('penghasilan'),
            'no_telp'     => $this->request->getPost('no_telp')
        ];

        if ($orangTuaModel->find($userId)) {
            $orangTuaModel->update($userId, $orangTuaData);
        } else {
            $orangTuaModel->insert($orangTuaData);
        }

        return redirect()->to('/user/biodata')->with('success', 'Data berhasil disimpan.');
    }

    public function akademik()
    {
        $userId = $this->getUserId();
        $data = [
            'title'    => 'Data Akademik',
            'akademik' => (new AkademikModel())->find($userId)
        ];
        return view('user/akademik', $data);
    }

    public function processAkademik()
    {
        $rules = [
            'asal_sekolah' => 'required',
            'npsn'         => 'required',
            'total_nilai'  => 'required|decimal'
        ];

        $akademikModel = new AkademikModel();
        $userId = $this->getUserId();
        $existing = $akademikModel->find($userId);

        // Require files on first insert, optional on update
        if (!$existing) {
            $rules['file_rapor']  = 'uploaded[file_rapor]|max_size[file_rapor,2048]|ext_in[file_rapor,pdf,jpg,jpeg,png]';
            $rules['file_ijazah'] = 'uploaded[file_ijazah]|max_size[file_ijazah,2048]|ext_in[file_ijazah,pdf,jpg,jpeg,png]';
            $rules['file_skkb']   = 'uploaded[file_skkb]|max_size[file_skkb,2048]|ext_in[file_skkb,pdf,jpg,jpeg,png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'user_id'      => $userId,
            'asal_sekolah' => $this->request->getPost('asal_sekolah'),
            'npsn'         => $this->request->getPost('npsn'),
            'total_nilai'  => $this->request->getPost('total_nilai')
        ];

        foreach (['file_rapor', 'file_ijazah', 'file_skkb'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $this->ensureUploadDir('akademik');
                $fileName = $file->getRandomName();
                $file->store('akademik/', $fileName);
                $data[$fileField] = $fileName;
            }
        }

        if ($existing) {
            $akademikModel->update($userId, $data);
        } else {
            $akademikModel->insert($data);
        }

        return redirect()->to('/user/akademik')->with('success', 'Data Akademik berhasil disimpan.');
    }

    public function prestasi()
    {
        $userId = $this->getUserId();
        $data = [
            'title'    => 'Data Prestasi',
            'prestasi' => (new PrestasiModel())->where('user_id', $userId)->findAll()
        ];
        return view('user/prestasi', $data);
    }

    public function processPrestasi()
    {
        $userId = $this->getUserId();
        $prestasiModel = new PrestasiModel();
        
        $kategoriArr = $this->request->getPost('kategori');
        $namaArr = $this->request->getPost('nama_prestasi');
        $pelaksanaArr = $this->request->getPost('pelaksana');
        $tahunArr = $this->request->getPost('tahun');
        $files = $this->request->getFileMultiple('file_sertifikat');

        // Delete old prestasi if we are replacing
        // Note: For simplicity, we just clear and re-insert or user can add more. 
        // Let's just append to existing ones.

        if ($kategoriArr && is_array($kategoriArr)) {
            foreach ($kategoriArr as $index => $kategori) {
                if (empty($namaArr[$index])) continue;

                $data = [
                    'user_id'       => $userId,
                    'kategori'      => $kategori,
                    'nama_prestasi' => $namaArr[$index],
                    'pelaksana'     => $pelaksanaArr[$index],
                    'tahun'         => $tahunArr[$index]
                ];

                if (isset($files[$index]) && $files[$index]->isValid() && !$files[$index]->hasMoved()) {
                    $this->ensureUploadDir('prestasi');
                    $fileName = $files[$index]->getRandomName();
                    $files[$index]->store('prestasi/', $fileName);
                    $data['file_sertifikat'] = $fileName;
                }

                $prestasiModel->insert($data);
            }
        }

        return redirect()->to('/user/prestasi')->with('success', 'Data Prestasi berhasil disimpan.');
    }

    public function berkas()
    {
        $userId = $this->getUserId();
        $data = [
            'title'  => 'Berkas Pendukung',
            'berkas' => (new BerkasPendukungModel())->find($userId)
        ];
        return view('user/berkas', $data);
    }

    public function processBerkas()
    {
        $userId = $this->getUserId();
        $berkasModel = new BerkasPendukungModel();
        $existing = $berkasModel->find($userId);

        $rules = [];
        if (!$existing) {
            $rules['file_kk']   = 'uploaded[file_kk]|max_size[file_kk,2048]|ext_in[file_kk,pdf,jpg,jpeg,png]';
            $rules['file_akte'] = 'uploaded[file_akte]|max_size[file_akte,2048]|ext_in[file_akte,pdf,jpg,jpeg,png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = ['user_id' => $userId];
        
        foreach (['file_kk', 'file_pkh', 'file_kip', 'file_akte'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $this->ensureUploadDir('berkas');
                $fileName = $file->getRandomName();
                $file->store('berkas/', $fileName);
                $data[$fileField] = $fileName;
            }
        }

        if ($existing) {
            $berkasModel->update($userId, $data);
        } else {
            $berkasModel->insert($data);
        }

        return redirect()->to('/user/berkas')->with('success', 'Berkas Pendukung berhasil diunggah.');
    }

    public function resume()
    {
        $userId = $this->getUserId();
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        
        $data = [
            'title'    => 'Resume & Kirim Pendaftaran',
            'progress' => $this->getProgress(),
            'user'     => $user
        ];
        return view('user/resume', $data);
    }

    public function kirimPendaftaran()
    {
        $progress = $this->getProgress();
        if ($progress < 100) {
            return redirect()->back()->with('error', 'Harap lengkapi semua data wajib sebelum mengirim pendaftaran.');
        }

        $userId = $this->getUserId();
        $userModel = new UserModel();
        
        $userModel->update($userId, ['status_pendaftaran' => 'Menunggu Verifikasi']);

        return redirect()->to('/user/dashboard')->with('success', 'Pendaftaran berhasil dikirim! Menunggu verifikasi admin.');
    }

    public function account()
    {
        $data = [
            'title' => 'Manajemen Akun'
        ];
        return view('user/account', $data);
    }

    public function processAccount()
    {
        $rules = [
            'password_lama' => 'required',
            'password_baru' => 'required|min_length[6]',
            'konfirmasi'    => 'required|matches[password_baru]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = $this->getUserId();
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (password_verify((string)$this->request->getPost('password_lama'), $user['password'])) {
            $userModel->update($userId, [
                'password' => password_hash((string)$this->request->getPost('password_baru'), PASSWORD_DEFAULT)
            ]);
            return redirect()->to('/user/account')->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }
    }
}
