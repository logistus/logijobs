<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Sinan Yilmaz',
            'username' => 'logi',
            'email' => 'logistus@gmail.com',
            'password' => bcrypt('646102'),
            'verified' => true
        ]);
    }
}
