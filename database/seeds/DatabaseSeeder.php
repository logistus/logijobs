<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert(
            ['name' => 'İstanbul Avrupa'],
            ['name' => 'İstanbul Anadolu'],
            ['name' => 'Ankara'],
            ['name' => 'İzmir'],
            ['name' => 'Bursa']
        );

        DB::table('counties')->insert(
          ['city_id' => 1, 'name' => 'Sarıyer'],
          ['city_id' => 1, 'name' => 'Bahçelievler'],
          ['city_id' => 1, 'name' => 'Bakırköy'],
          ['city_id' => 1, 'name' => 'Küçükçekmece'],
          ['city_id' => 1, 'name' => 'Başakşehir'],
          ['city_id' => 1, 'name' => 'Avcılar'],
          ['city_id' => 1, 'name' => 'Esenyurt'],
          ['city_id' => 1, 'name' => 'Arnavutköy'],
          ['city_id' => 1, 'name' => 'Büyükçekmece'],
          ['city_id' => 1, 'name' => 'Beylikdüzü'],
          ['city_id' => 1, 'name' => 'Çatalca'],
          ['city_id' => 1, 'name' => 'Silivri'],
          ['city_id' => 1, 'name' => 'Bağcılar'],
          ['city_id' => 1, 'name' => 'Bayrampaşa'],
          ['city_id' => 1, 'name' => 'Beyoğlu'],
          ['city_id' => 1, 'name' => 'Beşiktaş'],
          ['city_id' => 1, 'name' => 'Şişli'],
          ['city_id' => 1, 'name' => 'Kağıthane'],
          ['city_id' => 1, 'name' => 'Eyüp'],
          ['city_id' => 1, 'name' => 'Gaziosmanpaşa'],
          ['city_id' => 1, 'name' => 'Fatih'],
          ['city_id' => 1, 'name' => 'Sultangazi'],
          ['city_id' => 1, 'name' => 'Zeytinburnu'],
          ['city_id' => 1, 'name' => 'Güngören'],
          ['city_id' => 1, 'name' => 'Esenler'],
          ['city_id' => 2, 'name' => 'Sancaktepe'],
          ['city_id' => 2, 'name' => 'Sultanbeyli'],
          ['city_id' => 2, 'name' => 'Pendik'],
          ['city_id' => 2, 'name' => 'Tuzla'],
          ['city_id' => 2, 'name' => 'Şile'],
          ['city_id' => 2, 'name' => 'Kartal'],
          ['city_id' => 2, 'name' => 'Maltepe'],
          ['city_id' => 2, 'name' => 'Çekmeköy'],
          ['city_id' => 2, 'name' => 'Beykoz'],
          ['city_id' => 2, 'name' => 'Ümraniye'],
          ['city_id' => 2, 'name' => 'Ataşehir'],
          ['city_id' => 2, 'name' => 'Kadıköy'],
          ['city_id' => 2, 'name' => 'Üsküdar'],
          ['city_id' => 2, 'name' => 'Adalar']
        );
    }
}
