<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbRapatEvaluasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_rapat_evaluasi', function (Blueprint $table) {
            $table->string('evaluationMeeting_id',200)->primary();
            $table->string('evaluationMeeting',200);
            $table->string('place',30);
            $table->datetime('date');
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
        Schema::dropIfExists('tb_rapat_evaluasi');
    }
}
