<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class SuperadminSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        // Check if superadmin account already exists to prevent duplicates
        $existing = $userModel->where('email', 'superadmin@app.com')->first();

        if ($existing) {
            echo "Akun superadmin sudah ada, skip insert.\n";
            return;
        }

        $userModel->insert([
            'email'       => 'superadmin@app.com',
            'username'    => 'superadmin',
            'password'    => password_hash('superadmin123', PASSWORD_DEFAULT),
            'role'        => 'superadmin',
            'is_verified' => true,
        ]);

        echo "Akun superadmin berhasil dibuat!\n";
        echo "Email    : superadmin@app.com\n";
        echo "Password : superadmin123\n";
    }
}
