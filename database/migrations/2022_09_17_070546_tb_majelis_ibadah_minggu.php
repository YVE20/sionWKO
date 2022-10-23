<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbMajelisIbadahMinggu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_majelis_ibadah_minggu', function (Blueprint $table) {
            $table->string('assembly_id',200)->primary();
            $table->string('serviceCategory_id',200);
            $table->string('assembly',200);
            $table->string('coordinator',200);
            $table->string('khadim_companion',200);
            $table->string('uniform',200);
            $table->datetime('sermon_date');
            $table->time('time');
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_majelis_ibadah_minggu');
    }
}
