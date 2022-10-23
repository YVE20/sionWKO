<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbDataSidi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_data_sidi', function (Blueprint $table) {
            $table->string('sidi_id',200)->primary();
            $table->string('full_name',200);
            $table->string('gender',30);
            $table->string('place_ofBirth',200);
            $table->datetime('date_ofBirth');
            $table->string('NIK',30);
            $table->string('baptism_file',200);
            $table->string('church',200);
            $table->string('father_name',200);
            $table->string('mother_name',200);
            $table->string('address',200);
            $table->string('marriage_certificate',200);
            $table->string('photo',200);
            $table->string('phone_number',30);
            $table->datetime('date_ofSIDI');
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
        Schema::dropIfExists('tb_data_sidi');
    }
}
