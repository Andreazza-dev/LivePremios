<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionLinkGroupRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_link_group_rules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rule_id')->unsigned()->comment('FK Rules Type');
            $table->foreign('rule_id')->references('id')->on('permission_rules');
            $table->bigInteger('group_id')->unsigned()->comment('FK Menu');
            $table->foreign('group_id')->references('id')->on('permission_groups');
            $table->timestamps();
        });

        DB::table('permission_link_group_rules')->insert([
            'group_id' => 35,
            'rule_id' => 20001
        ]);

        DB::table('permission_link_group_rules')->insert([
            'group_id' => 35,
            'rule_id' => 20002
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_link_group_rules');
    }
}
