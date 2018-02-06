<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
            [
                'user_id' => 1, 
                'name' => 'speedway',
                'url' => 'http://trafficspeedway.com/personal/splash34.php?rid=8435',
                'credits' => 100,
                'status' => 'active'
            ],
            [
                'user_id' => 1,
                'name' => 'gloabalhits2u',
                'url' => 'http://globalhits2u.com/splashpage.php?splashid=4&rid=128',
                'credits' => 100,
                'status' => 'active'
            ],
            [
                'user_id' => 1,
                'name' => 'sunshinesurfclub',
                'url' => 'http://sunshinesurfclub.com/splash/personal/splash2.php?rid=91',
                'credits' => 100,
                'status' => 'active'
            ],
            [
                'user_id' => 1,
                'name' => 'hungryforhits',
                'url' => 'http://hungryforhits.com/profilepage.php?id=17',
                'credits' => 100,
                'status' => 'active'
            ],
            [
                'user_id' => 1,
                'name' => 'trendtraxpro',
                'url' => 'http://trendtraxpro.com/splash/personal/splash1.php?rid=349',
                'credits' => 100,
                'status' => 'active'
            ]
        ]);
    }
}
