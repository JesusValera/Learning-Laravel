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
        //$professions = DB::select('SELECT id FROM professions WHERE title = ? LIMIT 0,1', ["Back-end developer"]);
        //dd($professions);
        $professionId = DB::table('professions')
            ->select('id')
            ->where('title', 'LIKE', 'UI%')
            ->value('id');
        //dd($professionId);

        DB::table('users')->insert([
            'name' => 'Jesus Valera',
            'email' => 'jesus@example.com',
            'password' => bcrypt('password'),
            'profession_id' => $professionId,
        ]);

        DB::insert('INSERT INTO users (name, email, password, profession_id) VALUES (:name, :email, :password, :profession_id)', [
            'name' => 'Juan Valera',
            'email' => 'juan@example.com',
            'password' => bcrypt('password2'),
            'profession_id' => $professionId,
        ]);

    }
}
