<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->string('user_id',200)->primary();
            $table->string('name',200);
            $table->string('email',200);
            $table->string('username',200);
            $table->string('phone',200);
            $table->string('password',200);
            $table->string('gender',10);
            $table->string('picture',200);
            $table->string('level',30);
            $table->string('status',30);
            $table->string('remember_token',200);
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
        Schema::dropIfExists('tb_user');
    }
}
