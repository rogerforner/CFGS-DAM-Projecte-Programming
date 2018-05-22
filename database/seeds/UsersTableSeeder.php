<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Configuració (.env).
        $name     = env('USER_ADMIN_NAME');
        $email    = env('USER_ADMIN_EMAIL');
        $password = env('USER_ADMIN_PASS');

        // Administrador/ra
        User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => bcrypt($password)
        ]);

        // Usuaris de prova
        User::create([
            'name'     => 'Usuari A',
            'email'    => 'usuaria@example.com',
            'password' => bcrypt(123456)
        ]);
        User::create([
            'name'     => 'Usuari B',
            'email'    => 'usuarib@example.com',
            'password' => bcrypt(123456)
        ]);
        User::create([
            'name'     => 'Usuari C',
            'email'    => 'usuaric@example.com',
            'password' => bcrypt(123456)
        ]);
        User::create([
            'name'     => 'Usuari D',
            'email'    => 'usuarid@example.com',
            'password' => bcrypt(123456)
        ]);
    }
}
