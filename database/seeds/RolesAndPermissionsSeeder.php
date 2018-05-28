<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resetejar la caché de rols i permisos.
        app()['cache']->forget('spatie.permission.cache');

        // Crear Permisos
        // ... Es decideix no emprar-ne per falta de temps.

        // Crear Rols
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'teacher']);
        $role = Role::create(['name' => 'student']);
    }
}
