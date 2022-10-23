<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbKhadim extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_khadim', function (Blueprint $table) {
            $table->string('khadim_id',200)->primary();
            $table->string('serviceCategory_id',200);
            $table->string('theme',200);
            $table->string('khadim',200);
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
        Schema::dropIfExists('tb_khadim');
    }
}
