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
        $table = 'tblbitacoras';
        $comments = 'Tabla de registros de bitacora de acciones';
        Schema::create($table, function (Blueprint $table) {
            $table->id('id_Bitacora')->comment('Primary key');
            $table->foreignId('id_Usuario')->comment('Clave foranea del usuario');
            $table->foreignId('cve_accion')->comment('Clave foranea de la accion');
            $table->date('fecha')->comment('Fecha de registro de bitacora');
            $table->tinyInteger('activo',false,true)->comment('Estado del registro');
            $table->timestamps();

            $table->foreign('id_Usuario')->references('id')->on('tblusuarios')->onDelete('cascade');
            $table->foreign('cve_accion')->references('cve_accion')->on('tblacciones')->onDelete('cascade');
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

        //Schema::table('tblbitacoras',function (Blueprint $table)
        //{
        //    $table->dropIfExists(['foreign_id']);
        //});
        //
        Schema::dropIfExists('tblbitacoras');
    }

};
