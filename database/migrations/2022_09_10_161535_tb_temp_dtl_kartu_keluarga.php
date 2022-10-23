<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbTempDtlKartuKeluarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_temp_dtl_kartu_keluarga', function (Blueprint $table) {
            $table->id('number');
            $table->string('familyCard_id',200);
            $table->string('full_name',200);
            $table->string('NIK',200);
            $table->string('gender',30);
            $table->string('place_ofBith',200);
            $table->datetime('date_ofBirth');
            $table->string('religion',30);
            $table->string('education',30);
            $table->string('job',200);
            $table->string('blood',30);
            $table->string('marriage',30);
            $table->datetime('date_ofMarriage');
            $table->string('family_status',30);
            $table->string('citizenship',200);
            $table->string('paspor',200);
            $table->string('fatherName',200);
            $table->string('motherName',200);
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
        Schema::dropIfExists('tb_temp_dtl_kartu_keluarga');
    }
}
