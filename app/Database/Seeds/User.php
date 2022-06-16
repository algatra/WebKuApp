<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $list_gender = ['laki-laki', 'perempuan'];
        for ($i = 0; $i < 100; $i++) {
            $nama = $faker->name;
            $username = strtolower(str_replace(" ", "", $nama));
            $random = array_rand($list_gender);
            $gender = $list_gender[$random];
            $data = [
                'username' => $username,
                'password' => 'admin',
                'nama' => $nama,
                'alamat' => $faker->address,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => Time::createFromTimestamp($faker->unixTime()),
                'gender' => $gender,
                'telepon' => $faker->phoneNumber,
                'email' => $username . '@gmail.com',
                'avatar' => $gender == 'laki-laki' ? 'default1.jpg' : 'default2.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ];

            $this->db->table('user')->insert($data);
        }
    }
}
