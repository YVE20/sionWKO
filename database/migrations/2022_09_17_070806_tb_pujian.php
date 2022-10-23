<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbPujian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pujian', function (Blueprint $table) {
            $table->string('singing_id',200)->primary();
            $table->string('serviceCategory_id',200);
            $table->string('singer',200);
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
        Schema::dropIfExists('tb_pujian');
    }
}
