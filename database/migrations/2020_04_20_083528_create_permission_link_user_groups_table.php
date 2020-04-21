<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreatePermissionLinkUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_link_user_groups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('FK Users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('group_id')->unsigned()->comment('FK Menu');
            $table->foreign('group_id')->references('id')->on('permission_groups');
            $table->timestamps();
        });

        $user_id = DB::table('users')->min('id');
        if(isset($user_id) AND $user_id >= 1){
            DB::table('permission_link_user_groups')->insert([
                'user_id' => $user_id,
                'group_id' => 35
            ]);
            print('inside');
        }else{
            $value = Str::random(40);
            DB::table('users')->insert([
                'name' => 'Develop System',
                'email' => 'system@andreazza.dev',
                'password' => Hash::make($value)
            ]);

            $user_id = DB::table('users')->min('id');

            DB::table('permission_link_user_groups')->insert([
                'user_id' => $user_id,
                'group_id' => 35
            ]);

            echo("\n YOUR FIRST LOGIN    => system@andreazza.dev \n");
            echo(" YOUR FIRST PASSWORD => " . $value . "\n\n");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_link_user_groups');
    }
}
