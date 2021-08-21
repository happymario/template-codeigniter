<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
        $data = [
            'username' => 'darth',
            'email'    => 'darth@theempire.com'
        ];

        // Simple Queries
        $this->db->query("INSERT INTO tb_users (id, email) VALUES(:username:, :email:)", $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
	}
}
