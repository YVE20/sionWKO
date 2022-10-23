<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbPembagianMajelis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_data_majelis', function (Blueprint $table) {
            $table->string('assemblyData_id',200)->primary();
            $table->string('assembly_group',200);
            $table->string('aseembly_name',30);
            $table->date('sermon_date');
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
        Schema::dropIfExists('tb_data_majelis');
    }
}
