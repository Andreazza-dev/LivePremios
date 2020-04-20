<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();

            $table->string('twitch_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('nick')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->string('permissao')->default('U')->comment('[U]ser - [M]oderador - [A]dmin - [P]arceiro');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
