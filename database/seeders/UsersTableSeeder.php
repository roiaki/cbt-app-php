<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ←これを追加

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        for ($i = 1; $i <= 100; $i++) {
            DB::table('users')->insert([
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@test.com',
                'password' => password_hash('testtest', PASSWORD_DEFAULT),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        */
    }
}
