<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFaviconToSettings extends Migration
{
    public function up()
    {
        $this->forge->addColumn('settings', [
            'favicon' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'logo',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('settings', 'favicon');
    }
}
