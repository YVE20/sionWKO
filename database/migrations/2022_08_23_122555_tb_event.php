<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_event', function (Blueprint $table) {
            $table->string('event_id',200)->primary();
            $table->string('eventCategory_id',200);
            $table->string('speaker',200);
            $table->string('place',200);
            $table->datetime('sermon_date');
            $table->string('address',200);
            $table->string('theme',200);
            $table->string('contact_person',30);
            $table->string('photo',30);
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
        Schema::dropIfExists('tb_event');
    }
}
