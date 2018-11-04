<?php

use App\Profession;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1.- SQL.
        /*DB::insert('INSERT INTO professions (title) VALUES ("Back-end developer")');
        DB::insert('INSERT INTO professions (title) VALUES (?)', ['Back-end developer']);
        DB::insert('INSERT INTO professions (title) VALUES (:title)', ['title' => 'Back-end developer']);*/

        // 2.- Query builder.
        /*DB::table('professions')->insert([
            'title' => 'Back-end developer',
        ]);*/

        // 3.- Eloquent object.
        Profession::create([
            'title' => 'Back-end developer',
        ]);

        Profession::create([
            'title' => 'Front-end developer',
        ]);

        Profession::create([
            'title' => 'UI tester',
        ]);

        Profession::where('title', 'LIKE', 'Front-end developer')->delete();
    }
}
