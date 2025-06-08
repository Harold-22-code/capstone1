<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('events')->insert([
            ['name' => 'Wedding'],
            ['name' => 'Burial'],
            ['name' => 'Baptism'],
            ['name' => 'Confirmation'],
        ]);
    }
}
