<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbIbadah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ibadah', function (Blueprint $table) {
            $table->string('worship_id',200)->primary();
            $table->string('category_id',200);
            $table->string('speaker',200);
            $table->string('sermon_title',200);
            $table->string('sermon_content',200);
            $table->string('place',200);
            $table->datetime('sermon_date');
            $table->time('time');
            $table->string('speaker_contact',200);
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
        Schema::dropIfExists('tb_ibadah');
    }
}
