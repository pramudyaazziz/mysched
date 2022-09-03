<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'darth',
                'username' => 'darth',
                'email'    => 'darth@theempire.com',
                'password'    => password_hash('anjay', PASSWORD_BCRYPT),
            ],
            [
                'name' => 'luxe',
                'username' => 'luxe',
                'email'    => 'fancyluxe@theempire.com',
                'password'    => password_hash('anjay', PASSWORD_BCRYPT),
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
