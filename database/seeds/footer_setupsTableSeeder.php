<?php

use Illuminate\Database\Seeder;

class footer_setupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('footer_setups')->insert([
            'copyright' => 'owner',
            'facebook_url' => 'https://www.facebook.com/',
            'linkedin_url' => 'https://www.linkedin.com/feed/',
            'youtube_url' => 'https://www.youtube.com',
        ]);
    }
}
