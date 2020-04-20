<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetirarPremiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retirar_premios', function (Blueprint $table) {
            $table->id();

            $table->string('nick_premiado')->nullable()->comment('Nick Twitch User');
            $table->string('twitch_id_premiado')->nullable()->comment('ID Twitch Usuário Ganhador');

            $table->bigInteger('mod_autorizou')->unsigned()->nullable()->comment('Moderador que vinculou o usuário');
            $table->foreign('mod_autorizou')->references('id')->on('users');
            $table->datetime('data_vinculada')->nullable();


            $table->bigInteger('retirado_por')->unsigned()->nullable()->comment('Usuário que retirou o código');
            $table->foreign('retirado_por')->references('id')->on('users');
            $table->datetime('data_retirada')->nullable();
            $table->integer('status')->default(0)->comment('Status do prêmio');

            $table->string('book_code')->nullable();

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
        Schema::dropIfExists('retirar_premios');
    }
}
