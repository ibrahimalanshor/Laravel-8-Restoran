<?php

namespace Database\Seeders;

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
    	DB::table('site')->insert([
    		'name' => 'Restoran',
            'address' => 'Jln Raya Logitech'
    	]);
    }
}
