<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'status_pendaftaran' => [
                'type'       => 'ENUM',
                'constraint' => ['Belum Dikirim', 'Menunggu Verifikasi', 'Lolos Seleksi', 'Tidak Lolos'],
                'default'    => 'Belum Dikirim',
                'after'      => 'is_verified'
            ],
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'status_pendaftaran');
    }
}
