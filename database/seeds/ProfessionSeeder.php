<?php

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
        /*DB::insert('INSERT INTO professions (title) VALUES ("Back-end developer")');
        DB::insert('INSERT INTO professions (title) VALUES (?)', ['Back-end developer']);
        DB::insert('INSERT INTO professions (title) VALUES (:title)', [
            'title' => 'Back-end developer'
        ]);*/

        DB::table('professions')->insert([
            'title' => 'Back-end developer',
        ]);
        DB::table('professions')->insert([
            'title' => 'Front-end developer',
        ]);
        DB::table('professions')->insert([
            'title' => 'UI tester',
        ]);

        DB::delete('DELETE FROM professions WHERE title = :title', [
            'title' => 'Front-end developer',
        ]);
    }
}
