<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ←これを追加

class ColumnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            for ($j = 1; $j <= 100; $j++) {
                DB::table('events')->insert([
                    'user_id' => $i,
                    'title' => 'userid' . ' = ' . $i . ' test title ' . $j,
                    'content' => 'userid' . ' = ' . $i . ' test content ' . $j,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }

        for ($i = 1; $i <= 100; $i++) {
            for ($j = 1; $j <= 100; $j++) {
                DB::table('threecolumns')->insert([
                    'user_id' => $i,
                    'event_id' => $i,
                    'emotion_name' => 'userid' . ' = ' . $i . ' emotion-name ' . $j,
                    'emotion_strength' => $i,
                    'thinking' => 'userid' . ' = ' . $i . ' thinkings ' . $j,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
/*
        for ($i = 1; $i <= 100; $i++) {
            for ($j = 1; $j <= 7; $j++) {
                DB::table('emotion_threecolumn')->insert([
                    'threecol_id' => $i,
                    'emotion_id' => $j,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
        */

    }
}
