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
        $table = 'tblcontrolcarga';
        $comments = 'Tabla de registros de control de carga';
        Schema::create($table, function (Blueprint $table) {
            $table->id('id_control_carga')->comment('Clave primaria');
            $table->foreignId('id_usuario')->comment('Clave foranea del usuario');
            $table->tinyInteger('anio')->comment('Anio de la carga');
            $table->total('total')->comment('Total de carga del usuario');
            $table->tinyInteger('activo',false,true)->comment('Estado del registro');
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

        //Schema::table('tblcontrolcarga',function (Blueprint $table)
        //{
        //    $table->dropIfExists(['foreign_id']);
        //});
        //
        Schema::dropIfExists('tblcontrolcarga');
    }

};
