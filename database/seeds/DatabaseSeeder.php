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
        /* USUARIS/RIES
        --------------------------------------------------------------------- */
        $this->call(UsersTableSeeder::class);
        $this->command->info('Users table populated!');
    }
}
