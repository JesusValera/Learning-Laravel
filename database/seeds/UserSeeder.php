<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jesus Valera',
            'email' => 'jesus@example.com',
            'password' => bcrypt('password'),
            //'profession_id' => '1',
        ]);
    }
}
