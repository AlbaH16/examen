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
        $table = 'tblgrupos_sistema';
        $comments = 'Tabla de registros de grupos de sistemas';
        Schema::create($table, function (Blueprint $table) {
            $table->id('cve_grupo_sistema')->comment('Clave primaria');
            $table->text('descripcion_grupo')->comment('Descripcion del grupo');
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

        //Schema::table('grupos_sistema',function (Blueprint $table)
        //{
        //    $table->dropIfExists(['foreign_id']);
        //});
        //
        Schema::dropIfExists('grupos_sistema');
    }

};
