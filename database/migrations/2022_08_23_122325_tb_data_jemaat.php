<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbDataJemaat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_data_jemaat', function (Blueprint $table) {
            $table->string('congregation_id',200)->primary();
            $table->string('baptism_id',200);
            $table->string('sidi_id',200);
            $table->string('familyCard_id',200);
            $table->string('service_environtment',200);
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
        Schema::dropIfExists('tb_data_jemaat');
    }
}
