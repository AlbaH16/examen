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
        $table = 'tblacciones';
        $comments = 'Tabla de registros de acciones';
        Schema::create($table, function (Blueprint $table) {
            $table->id('cve_accion')->comment('Clave primaria');
            $table->text('descripcion')->comment('descripcion');
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

        //Schema::table('tblacciones',function (Blueprint $table)
        //{
        //    $table->dropIfExists(['foreign_id']);
        //});
        //
        Schema::dropIfExists('tblacciones');
    }

};
