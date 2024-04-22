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
        $table = 'tblsolicitudes';
        $comments = 'Tabla de registros de solicitudes';
        Schema::create($table, function (Blueprint $table) {
            $table->id('id_solicitud')->comment('Clave primaria');
            $table->foreignId('id_usuario_asignado')->comment('Clave foranea del usuario asignado');
            $table->string('nombre_solicitante')->comment('Nombre del solicitante');
            $table->string('paterno_solicitante')->comment('Apellido paterno del solicitante');
            $table->string('materno_solicitante')->comment('Apellido materno del solicitante');
            $table->dateTime('fecha_solicitud')->comment('Fecha de registro de la solicitud');
            $table->tinyInteger('activo',false,true)->default(1)->comment('Estado del registro');
            $table->timestamps();
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

        //Schema::table('tblsolicitudes',function (Blueprint $table)
        //{
        //    $table->dropIfExists(['foreign_id']);
        //});
        //
        Schema::dropIfExists('tblsolicitudes');
    }

};
