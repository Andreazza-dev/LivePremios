<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionLinkUserRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_link_user_rules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rule_id')->unsigned()->comment('FK Rules Type');
            $table->foreign('rule_id')->references('id')->on('permission_rules');
            $table->bigInteger('user_id')->unsigned()->comment('FK User');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('permission_link_user_rules');
    }
}
