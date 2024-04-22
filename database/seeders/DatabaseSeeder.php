<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\GrupoSistema;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $grupos_sistema = ['Grupo 1','Grupo 2','Asesor de Ventas'];

        foreach ($grupos_sistema as $value) {
            $grupo = new GrupoSistema();
            $grupo->descripcion_grupo = $value;
            $grupo->save();
        }

        for ($i=0; $i < 10 ; $i++) {
            $usuario = new User();
            $usuario->login ='usuario_'.($i+1);
            $usuario->password = Hash::make('secret1234.');
            $usuario->nombre = 'Usuario '.$i+1;
            $usuario->paterno = 'Apellido Paterno Usuario '.$i;
            $usuario->materno = 'Apellido Materno Usuario '.$i;
            $usuario->cve_grupo = $i > 7 ? 3 : rand(1,2);
            $usuario->save();
        }
    }
}
