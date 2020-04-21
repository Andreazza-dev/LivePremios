<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Menu Name');
            $table->string('description')->nullable()->comment('Description');
            $table->integer('status')->default(0)->comment('0 - Deactive, 1 - Active');
            $table->timestamps();
        });

        DB::table('permission_rules')->insert([
            'id' => 20001,
            'name' => 'Admin Menus',
            'description' => 'Permite Acessar os menus de admin',
            'status' => 1
        ]);

        DB::table('permission_rules')->insert([
            'id' => 20002,
            'name' => 'Cadastro de códigos',
            'description' => 'Permite acessar a página de cadastro de códigos dos ebooks',
            'status' => 1
        ]);

        DB::table('permission_rules')->insert([
            'id' => 20003,
            'name' => 'Acesso a Regras e Permissoes',
            'description' => 'Permite atribuir regras permissoes a grupos e usuários.',
            'status' => 1
        ]);

        DB::table('permission_rules')->insert([
            'id' => 20004,
            'name' => 'Cadastrar a Grupos e Regras',
            'description' => 'Permite cadastrar novos grupos e regras.',
            'status' => 1
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_rules');
    }
}
