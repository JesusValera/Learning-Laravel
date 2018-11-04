<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables(['professions', 'users']);

        $this->call(ProfessionSeeder::class);
        $this->call(UserSeeder::class);
    }

    public function truncateTables(array $tables): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($tables as $table) {
            DB::table($table)->truncate(); // Remove all entries from the table.
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
