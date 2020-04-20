<?php

namespace App\Http\Controllers;

use App\Models\RefCodigo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class ReferenciasController extends Controller
{

    /**
     *  VERIFICA SE O USUÁRIO POSSUI ALGUMA INDICAÇÃO!
     */
    public function verificaIndicacaoPendente($indicado_code){

        $codigo = RefCodigo::where('codigo', '=', $indicado_code)->first();
        if(isset($codigo) AND $codigo != null){
            if(isset($_COOKIE['_ind'])) {
                $indicacao = $_COOKIE['_ind'];
                return $_COOKIE['_ind'];
            }else{
                $minutes = 60;
                $user_ref = 1;
                $user_ref = Hash::make($user_ref);
                return redirect('/')->withCookie(cookie('_ind', $user_ref, $minutes));
            }
        }else{
            return redirect('/');
        }

    }


    /**
     * ABAIXO COMEÇA TODA A PARTE DE TELAS
     * SENDO ELAS A TELA QUE MOSTRA TODAS AS INDICAÇÕES
     * QUE O USUÁRIO CONSEGUIU TRAZER PARA O SITE!
     */

    public function showsIndicacao(){

    }

    public function createIndicacao(){

    }

    public function storeIndicacao(){

    }

    public function editIndicacao(){

    }
}
