<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveCodersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_coders', function (Blueprint $table) {
            $table->id();
            $table->string('canal')->comment('Nome do canal');
            $table->integer('status')->default(0)->comment('Canal Está Aprovado 1 = True || 0 = False');
            $table->bigInteger('aprovado_por')->unsigned()->nullable()->comment('FK de quem aprovou esse canal');
            $table->foreign('aprovado_por')->references('id')->on('users');
            $table->integer('especial')->default(0)->comment('Canal tem uma reputação especial');
            $table->bigInteger('solicitado_por')->unsigned()->comment('Quem solicitou a inclusão');
            $table->foreign('solicitado_por')->references('id')->on('users');
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
        Schema::dropIfExists('live_coders');
    }
}
