<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbPemusik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pemusik', function (Blueprint $table) {
            $table->string('musician_id',200)->primary();
            $table->string('serviceCategory_id',200);
            $table->string('projector',200);
            $table->string('infocus',200);
            $table->string('keyboard',200);
            $table->string('prokantor',200);
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
        Schema::dropIfExists('tb_pemusik');
    }
}
