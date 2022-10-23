<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbDataBaptis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_data_baptis', function (Blueprint $table) {
            $table->string('baptism_id',200)->primary();
            $table->string('full_name',200);
            $table->string('gender',30);
            $table->string('place_ofBirth',200);
            $table->datetime('date_ofBirth');
            $table->datetime('date_ofBaptism');
            $table->string('religion',30);
            $table->string('church',30);
            $table->string('father_name',200);
            $table->string('mother_name',200);
            $table->string('address',200);
            $table->string('pastor',200);
            $table->string('photo',200);
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
        Schema::dropIfExists('tb_data_baptis');
    }
}
