<?php
// 파일생성 php spark make:seeder
// 파일 실행 php spark db:seed ClientSeeder

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ClientSeeder extends Seeder
{
    public function run()
    {
        for($i = 0; $i < 10; $i++) {
            $this->db->table('tb_client')->insert($this->generateClient());
        }
    }

    private function generateClient()  {
        $faker = Factory::create();
        return [
          'name' => $faker->name(),
          'email' => $faker->email,
          'retainer_fee' => random_int(100000, 100000000)
        ];
    }
}
