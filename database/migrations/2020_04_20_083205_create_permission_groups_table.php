<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Name Group');
            $table->integer('status')->default(1)->comment('0 Deactive - 1 Active');
            $table->timestamps();
        });

        DB::table('permission_groups')->insert([
            'id' => 35,
            'name' => 'Developers'
        ]);

        DB::table('permission_groups')->insert([
            'id' => 30,
            'name' => 'Guest'
        ]);

        DB::table('permission_groups')->insert([
            'id' => 31,
            'name' => 'Moderadores'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_groups');
    }
}
