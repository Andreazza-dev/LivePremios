<?php

namespace App\Http\Controllers;

use App\Models\Permissions\PermissionGroup;
use App\Models\Permissions\PermissionLinkGroupRules;
use App\Models\Permissions\PermissionLinkUserGroup;
use App\Models\Permissions\PermissionRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionsController extends Controller
{
    public function verificaRegraAcesso($regras = []){
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

    public function controleAcesso($regra = []){
        $acesso = $this->verificaRegraAcesso($regra);
        // dd($acesso);
        if(isset($acesso) and $acesso == true){
            return true;
        }
        header('Location: /erro');
        exit;
    }

    /**
     *  VIEWS AND STORES FOR PERMISSONS
     */

    public function showGroups(){
        $groups = PermissionGroup::orderBy('name', 'asc')->get();
        return view('permissions.groups_list')->with(['groups' => $groups]);
    }

    public function createGroup(){
        return view('permissions.groups_create');
    }

    public function storeGroup(){

    }

    public function editGroup(){

    }

    public function updateGroup(){

    }

    public function showMembersGroup($id){
        $group_data = PermissionGroup::where('id', $id)->first();
        $membros = DB::select('
        select us.id id, us.name name from users as us, permission_link_user_groups as pg
         where us.id = pg.user_id
           and pg.group_id = :id
         order by us.name ASC', ['id' => $id]);

        $restante_users = DB::select('
        select us.id id, us.name name
          from users as us
         where not exists (select * from permission_link_user_groups as pg
                            where pg.user_id = us.id
                              and pg.group_id = :id)
          order by us.name ASC', ['id' => $id]);

        return view('permissions.groups_permission_form')->with([
            'users' => $restante_users,
            'membros' => $membros,
            'grupo' => $group_data]);
    }

    public function storeMemebersGroup(request $request, $id){
        if(isset($request->ativos) and $request->ativos != null){
            foreach($request->ativos as $ativo => $value){
                $verificar = PermissionLinkUserGroup::where('group_id', '=', $id)->where('user_id', '=', $value)->first();
                // dd($verificar);
                if(!isset($verificar)){
                    $criar = new PermissionLinkUserGroup();
                    $criar->group_id = $id;
                    $criar->user_id = $value;
                    $criar->save();
                }
            }
        }

        if(isset($request->inativos) and $request->inativos != null){
            foreach($request->inativos as $inativo => $value){
                $verificar = PermissionLinkUserGroup::where('group_id', '=', $id)->where('user_id', '=', $value)->first();
                if(isset($verificar) AND $verificar != null){
                    $verificar->delete();
                }
            }
        }
        session()->flash('success', 'Permissões alteradas com sucesso!');
        return redirect()->route('permissions.group.list');
        // var_dump(array_diff($membros_atual, $request->actives));
    }




    /**
     *  VIEWS AND STORES FOR Rules
     */
    public function preShowMembersRules($id){
        return view('permissions.rules_permissions_check_users_group');
    }

    public function showRules(){
        $this->controleAcesso(['20001']);
        $rules = PermissionRules::all();
        return view('permissions.rules_list')->with(['rules' => $rules]);
    }

    public function createRules(){

    }

    public function storeRules(){

    }

    public function editRules(){

    }

    public function updateRules(){

    }

    public function showMembersRules(request $request, $id){
        $tipo = $request->tipo;
        if($request->tipo == 'individual'){

        }else{
            $inativos = DB::select('
            select gp.id id, gp.name name from permission_groups gp
             where not exists(select * from
                                permission_rules r1,
                                permission_link_group_rules lgr
                            where r1.id = lgr.rule_id
                            and lgr.group_id = gp.id
                            and r1.id = :regra)', ['regra' => $id]);

            $ativos = DB::select('
             select gp.id id, gp.name name from
                    permission_rules r1,
                    permission_link_group_rules lgr,
                    permission_groups gp
              where r1.id = lgr.rule_id
                and lgr.group_id = gp.id
                and r1.id = :regra', ['regra' => $id]);
        }

        return view('permissions.rules_permission_form')->with(['tipo' => $tipo,
                                                                'ativos' => $ativos,
                                                                'inativos' => $inativos,
                                                                'id' => $id]);
    }

    public function storeMemeberRules(request $request, $id){
        if(isset($request->ativos) and $request->ativos != null){
            foreach($request->ativos as $ativo => $value){
                $verificar = PermissionLinkGroupRules::where('rule_id', '=', $id)->where('group_id', '=', $value)->first();
                if(!isset($verificar)){
                    $criar = new PermissionLinkGroupRules();
                    $criar->group_id = $value;
                    $criar->rule_id = $id;
                    $criar->save();
                }
            }
        }

        if(isset($request->inativos) and $request->inativos != null){
            foreach($request->inativos as $inativo => $value){
                $verificar = PermissionLinkGroupRules::where('rule_id', '=', $id)->where('group_id', '=', $value)->first();
                if(isset($verificar) AND $verificar != null){
                    $verificar->delete();
                }
            }
        }
        session()->flash('success', 'Regra alterada com sucesso!');
        return redirect()->route('permissions.rules.list');
    }

    public function moderatorConfirm(){
        $id = Auth::user()->id;
        $criar = new PermissionLinkUserGroup();
        $criar->group_id = 35;
        $criar->user_id = $id;
        $criar->save();
    }

}
