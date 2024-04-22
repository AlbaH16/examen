<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'tblusuarios';
        $comments = 'Tabla de registros de usuarios';
        Schema::create($table, function (Blueprint $table) {
            $table->id()->comment('Clave primaria');
            $table->string('login')->comment('');
            $table->string('password')->comment('');
            $table->string('nombre')->comment('Nombre del Usuario');
            $table->string('paterno')->comment('Apellido paterno del usuario');
            $table->string('materno')->comment('Apellido materno del usuario');
            $table->tinyInteger('activo',false,true)->default(1)->comment('Estado del registro');
            $table->foreignId('cve_grupo')->nullable()->comment('Clave foranea del grupo al que pertenece el usuario');
            $table->timestamps();

            $table->foreign('cve_grupo')->references('cve_grupo_sistema')->on('tblgrupos_sistema')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE ".$table." comment '".$comments."'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //Schema::table('usuarios',function (Blueprint $table)
        //{
        //    $table->dropIfExists(['foreign_id']);
        //});
        //
        Schema::dropIfExists('usuarios');
    }

};
