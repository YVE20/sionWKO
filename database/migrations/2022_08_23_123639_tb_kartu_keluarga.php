<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbKartuKeluarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kartu_keluarga', function (Blueprint $table) {
            $table->string('familyCard_id',200)->primary();
            $table->string('family_headName',200);
            $table->string('address',200);
            $table->string('RTRW',30);
            $table->string('zipCode',30);
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
        Schema::dropIfExists('tb_kartu_keluarga');
    }
}
