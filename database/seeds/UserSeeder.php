<?php

use App\Profession;
use App\User;

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

        $professionId2 = Profession::all()->last()->id;

        DB::insert('INSERT INTO users (name, email, password, profession_id, website) VALUES (:name, :email, :password, :profession_id, :website)', [
            'name' => 'Juan Valera',
            'email' => 'juan@example.com',
            'password' => bcrypt('password2'),
            'profession_id' => $professionId,
            'website' => 'http://juan.com',
        ]);

        DB::table('users')->insert([
            'name' => 'Jesus Valera',
            'email' => 'jesus@example.com',
            'password' => bcrypt('password'),
            'profession_id' => $professionId,
        ]);

        User::create([
            'name' => 'Jose Valera',
            'email' => 'jose@example.com',
            'password' => bcrypt('password3'),
            'profession_id' => $professionId2,
        ]);

        // Factory -> create user with random values.
        factory(User::class)->create([
            'profession_id' => $professionId2,
        ]);

        factory(User::class, 10)->create();
    }
}
