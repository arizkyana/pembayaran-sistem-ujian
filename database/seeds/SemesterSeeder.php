<?php

use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('semester')->insert([
        [
        'kode_semester' => '120192020',
        'label' => '1 - 2019 / 2020'
        ],
        [
        'kode_semester' => '220192020',
        'label' => '2 - 2019 / 2020'
        ]
        ]);
    }
}