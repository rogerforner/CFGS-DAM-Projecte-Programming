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
        $adminUser = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => bcrypt($password)
        ]);

        // Professors/res
        $teacherA = User::create([
            'name'     => 'Profe A',
            'email'    => 'profea@example.com',
            'password' => bcrypt(123456)
        ]);
        $teacherB = User::create([
            'name'     => 'Profe B',
            'email'    => 'profeb@example.com',
            'password' => bcrypt(123456)
        ]);

        // Estudiants
        $studentUser = User::create([
            'name'     => 'Estudiant',
            'email'    => 'estudiant@example.com',
            'password' => bcrypt(123456)
        ]);

        // Assignació dels rols.
        $adminUser->assignRole('admin');
        $teacherA->assignRole('teacher');
        $teacherB->assignRole('teacher');
        $studentUser->assignRole('student');
    }
}
