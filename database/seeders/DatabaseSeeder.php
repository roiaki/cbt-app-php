<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([HabitsTableSeeder::class]);
        //$this->call([UsersTableSeeder::class]);
        //$this->call([ColumnsTableSeeder::class]);
    }
}
