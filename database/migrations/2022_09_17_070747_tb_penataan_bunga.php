<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbPenataanBunga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penataan_bunga', function (Blueprint $table) {
            $table->string('flowerArrangement_id',200)->primary();
            $table->string('serviceCategory_id',200);
            $table->string('mothersOnDuty',200);
            $table->string('coordinator',200);
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
        Schema::dropIfExists('tb_penataan_bunga');
    }
}
