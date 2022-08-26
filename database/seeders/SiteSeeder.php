<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            'name' => 'SiteForTesting1',
            'url' => 'site_for_testing',
        ]);
        DB::table('sites')->insert([
            'name' => 'Darknet',
            'url' => 'deep_dark_network',
        ]);
    }
}
