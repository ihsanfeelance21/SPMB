<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSuperadminRole extends Migration
{
    public function up()
    {
        // Expand the ENUM to include 'superadmin'
        $this->db->query("ALTER TABLE users MODIFY COLUMN role ENUM('user','admin','superadmin') NOT NULL DEFAULT 'user'");
    }

    public function down()
    {
        // Revert back to original ENUM
        $this->db->query("ALTER TABLE users MODIFY COLUMN role ENUM('user','admin') NOT NULL DEFAULT 'user'");
    }
}
