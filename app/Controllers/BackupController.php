<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BackupController extends BaseController
{
    public function index()
    {
        helper('number'); // Untuk memformat ukuran file

        $backupPath = WRITEPATH . 'backups/';

        // Buat folder jika belum ada
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        // Ambil semua file sql di dalam folder backup
        $files = scandir($backupPath);
        $backups = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $filePath = $backupPath . $file;
                $backups[] = [
                    'name'      => $file,
                    'timestamp' => filemtime($filePath),
                    'date'      => date('d M Y, H:i', filemtime($filePath)),
                    'size'      => number_to_size(filesize($filePath)),
                    'status'    => 'Sukses'
                ];
            }
        }

        // Urutkan dari yang terbaru
        usort($backups, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        $data = [
            'title'   => 'Backup & Restore Database',
            'backups' => $backups
        ];

        return view('admin/backup', $data);
    }

    public function create()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $sql = "-- SPMB Database Backup\n";
        $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $sql .= "-- Structure and data for table `{$table}`\n";
            $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";

            $query = $db->query("SHOW CREATE TABLE `{$table}`");
            $row = $query->getRowArray();
            $sql .= $row['Create Table'] . ";\n\n";

            $queryData = $db->query("SELECT * FROM `{$table}`");
            $resultData = $queryData->getResultArray();

            if (count($resultData) > 0) {
                $sql .= "-- Data for table `{$table}`\n";
                foreach ($resultData as $row) {
                    $vals = [];
                    foreach ($row as $val) {
                        if ($val === null) {
                            $vals[] = 'NULL';
                        } else {
                            $vals[] = $db->escape($val);
                        }
                    }
                    $sql .= "INSERT INTO `{$table}` VALUES (" . implode(', ', $vals) . ");\n";
                }
                $sql .= "\n";
            }
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        $filename = 'backup_ppdb_' . date('Ymd_His') . '.sql';
        $backupPath = WRITEPATH . 'backups/';

        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        // Simpan file ke server (bukan langsung download)
        if (file_put_contents($backupPath . $filename, $sql)) {
            return redirect()->to('/admin/backup')->with('success', 'Backup berhasil dibuat dan disimpan ke riwayat.');
        } else {
            return redirect()->to('/admin/backup')->with('error', 'Gagal membuat file backup.');
        }
    }

    public function downloadFile($filename)
    {
        $path = WRITEPATH . 'backups/' . $filename;
        if (file_exists($path)) {
            return $this->response->download($path, null);
        }
        return redirect()->to('/admin/backup')->with('error', 'File tidak ditemukan.');
    }

    public function deleteFile($filename)
    {
        $path = WRITEPATH . 'backups/' . $filename;
        if (file_exists($path)) {
            unlink($path);
            return redirect()->to('/admin/backup')->with('success', 'File backup berhasil dihapus.');
        }
        return redirect()->to('/admin/backup')->with('error', 'File tidak ditemukan.');
    }

    public function restore()
    {
        $file = $this->request->getFile('file_sql');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'Gagal mengunggah file.');
        }

        if ($file->getClientExtension() !== 'sql') {
            return redirect()->back()->with('error', 'Format file harus .sql');
        }

        $sqlString = file_get_contents($file->getTempName());

        $sqlString = preg_replace('/--.*$/m', '', $sqlString);
        $sqlString = preg_replace('/^\s*$/m', '', $sqlString);
        $sqlString = preg_replace('/\/\*.*?\*\//s', '', $sqlString);

        $queries = explode(";\n", $sqlString);

        $db = \Config\Database::connect();

        try {
            $db->transStart();
            $db->query("SET FOREIGN_KEY_CHECKS=0");

            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query)) {
                    $db->query($query);
                }
            }

            $db->query("SET FOREIGN_KEY_CHECKS=1");
            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat mengeksekusi kueri restore.');
            }

            return redirect()->to('/admin/backup')->with('success', 'Database berhasil dipulihkan!');
        } catch (\Exception $e) {
            $db->query("SET FOREIGN_KEY_CHECKS=1");
            return redirect()->back()->with('error', 'Gagal melakukan restore: ' . $e->getMessage());
        }
    }
}
