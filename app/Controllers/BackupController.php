<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BackupController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Backup & Restore Database'
        ];
        return view('admin/backup', $data);
    }

    public function download()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $sql = "-- SPMB Database Backup\n";
        $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";

        // To avoid foreign key constraint errors during restore
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

        $filename = 'backup_spmb_' . date('Ymd_His') . '.sql';

        return $this->response->download($filename, $sql);
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
        
        // Remove comments
        $sqlString = preg_replace('/--.*$/m', '', $sqlString);
        $sqlString = preg_replace('/^\s*$/m', '', $sqlString);
        $sqlString = preg_replace('/\/\*.*?\*\//s', '', $sqlString);

        // A simple query splitter based on semicolon at the end of the line
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

            return redirect()->to('/admin/backup')->with('success', 'Database berhasil di-restore!');

        } catch (\Exception $e) {
            $db->query("SET FOREIGN_KEY_CHECKS=1");
            return redirect()->back()->with('error', 'Gagal melakukan restore: ' . $e->getMessage());
        }
    }
}
