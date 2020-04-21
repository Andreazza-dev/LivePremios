<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function verificaRegra($regras = []){
        $permissao = false;
        $user = Auth::user()->id;
        $regras_liberadas = [];
        $regras_grupo = DB::select('select pr.id from users us,
                                    permission_link_user_groups ug,
                                    permission_link_group_rules gr,
                                    permission_rules pr
                            where ug.user_id = us.id
                            and gr.group_id = ug.group_id
                            and gr.rule_id = pr.id
                            and us.id = :user', ['user' => $user]);
        foreach($regras_grupo as $grupo){
            $regras_liberadas[] = $grupo->id;
        }

        foreach($regras as $key){
            if(in_array($key, $regras_liberadas)){
                $permissao = true;
            }
        }
        if($permissao == true){
            return true;
        }
        return false;
    }

    public function verificaAcesso($regras = []){
        $acesso = $this->verificaRegra($regras);
        // dd($acesso);
        if(isset($acesso) and $acesso == true){
            return true;
        }
        header('Location: /erro');
        exit;
    }
}
