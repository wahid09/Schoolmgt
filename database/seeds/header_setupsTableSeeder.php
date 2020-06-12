<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class header_setupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header_setups')->insert([
            'title' => 'A simple site',
            'slogan' => 'sustainable development',
            'address' => '5B. 27 West Tejturi Bazar, Tejgoan Dhaka',
            'mobile' => '01765153253',
        ]);
    }
}
