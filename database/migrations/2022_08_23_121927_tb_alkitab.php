<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbAlkitab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_alkitab', function (Blueprint $table) {
            $table->string('bible_id',200)->primary();
            $table->string('bibleCategory_id',200);
            $table->string('title',200);
            $table->string('book',200);
            $table->string('paragraph',200);
            $table->string('chapter',200);
            $table->string('description',200);
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
        Schema::dropIfExists('tb_alkitab');
    }
}
