<?php

namespace App\Http\Controllers;

use App\Models\RetirarPremio;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetirarPremioController extends Controller
{
    public function index(){
        $return = [];
        $user = Auth::user();
        $dados = RetirarPremio::where('twitch_id_premiado', '=', $user->twitch_id)->orderBy('data_vinculada', 'desc')->get();
        foreach($dados as $dado){
            $data = Carbon::now()->diffInMinutes($dado->data_vinculada) . ' minutos atrás';
            if($data >= 60){
                $data = Carbon::now()->diffInHours($dado->data_vinculada) . ' horas atrás';
                if($data >= 24){
                    $data = $dado->data_vinculada;
                }
            }
            $return[] = [
                'avatar' => $user->avatar, // user
                'name' => $user->nick, // user
                'registred' => $user->created_at, // user
                'status' => $dado->status, // premios
                'vinculado_data' => $data, // premios
                'retirado' => $dado->retirado_por, // premios
                'retirado_data' => $dado->data_retirada, // premios
                'premio_id' => $dado->id
            ];
        }

        return view('site.premios.retirar')->with(['dados' => $return]);
    }

    public function verificaPremioRetirada(Request $request){
        $user = Auth::user()->twitch_id;
        $premio = RetirarPremio::where('id', '=', $request->premio_id)->where('twitch_id_premiado', '=', $user)->first();
        if(isset($premio) and $premio != null){
            if($premio->status == 2){
                $data = ['msg' => 'premio_codigo', 'codigo' => $premio->book_code];
            }else{
                $data = ['msg' => 'confirmar_email'];
            }
        }else{
            $data = ['erro' => 'no_premio', 'msg' => 'Prêmio não existente', 'err_cod' => '5002'];
        }
        return response()->json($data, 200);
    }

    public function vicularPremioUser(request $request){
        $nick = $request->nick;
        $nick = str_replace([
            'https://twitch.tv/',
            'http://twitch.tv/',
            'https://www.twitch.tv/',
            'http://www.twitch.tv/',
            'twitch.tv/',
            'www.twitch.tv/'], '', $nick);
        $twitch = new TwitchController();
        $user_twitch = $twitch->getInformacoesCanal($nick);

        $dados = RetirarPremio::where('twitch_id_premiado', '=', NULL)->where('status', '=', '0')->get();

        if($user_twitch['status'] == 'success'){
            $user_twitch = $user_twitch[0];
            $data_verificada = Carbon::now()->subMinutes(15);
            $verificar_premio_recente = RetirarPremio::where('twitch_id_premiado', '=', $user_twitch['canal_id'])->where('data_vinculada', '>=', $data_verificada)->first();

            if(!isset($verificar_premio_recente)){
                $premio = RetirarPremio::where('twitch_id_premiado', '=', NULL)->where('status', '=', '0')->first();
                if(isset($premio) and $premio != null){
                    $premio->nick_premiado = $user_twitch['canal'];
                    $premio->twitch_id_premiado = $user_twitch['canal_id'];
                    $premio->mod_autorizou = Auth::user()->id;
                    $premio->status = 1;
                    $premio->data_vinculada = Carbon::now();
                    $premio->update();
                    session()->flash('success', 'Vinculado com sucesso!');
                    return redirect()->route('admin.dashboard.premios');
                }else{
                    session()->flash('error', 'Infelizmente não temos mais códigos disponíveis!');
                    return redirect()->route('admin.dashboard.premios');
                }
            }else{
                $moderador = User::where('id', '=', $verificar_premio_recente->mod_autorizou)->first();
                $data = Carbon::now()->diffInMinutes($verificar_premio_recente->data_vinculada);
                $msg = 'O moderador ' . $moderador->nick . ' Já vinculou um prêmio para este usuário a ' . $data . ' minutos atrás';
                session()->flash('error', $msg);
                return redirect()->route('admin.dashboard.premios');
            }
        }else{
            $data = ['status' => 'erro', 'msg' => 'Canal Não Encontrado'];
            return redirect()->route('admin.dashboard.premios');
        }
    }

    public function cadastrarCodigo(){
        $disponivel = RetirarPremio::where('status', '=', '0')->count();
        $resgatados = RetirarPremio::where('status', '=', '2')->count();
        $pendente = RetirarPremio::where('status', '=', '1')->count();
        $return = [
            'disponivel' => $disponivel,
            'resgatados' => $resgatados,
            'pendentes' => $pendente,
            'total' => ($disponivel + $resgatados + $pendente)
        ];
        return view('site.premios.cadastrar_codigo')->with(['contagem' => $return]);
    }

    public function storeCadastrarCodigo(Request $request){
        $erros = [];
        $codigos = $request->array;
        foreach ($codigos as $key => $value) {
            $buscar = RetirarPremio::where('book_code', '=', $value['codigo'])->first();
            if(isset($buscar) and $buscar != null){
                $erros[] = ['codigo' => $value['codigo']];
            }else{
                $premio = new RetirarPremio();
                $premio->book_code = $value['codigo'];
                $premio->save();
            }
        }
        if(isset($erros) and $erros != null){
            $msg_erro = '';
            foreach ($erros as $erro){
                $msg_erro .= $erro['codigo'] . ', ';
            }
            session()->flash('error', 'Alguns códigos já existiam na base ' . $msg_erro);
        }
        session()->flash('success', 'Cadastro dos códigos realizado com sucesso!');
        return redirect()->route('admin.dashboard.premios');
    }

    public function dashboardPremios(){
        $return = [];
        $dados = RetirarPremio::where('twitch_id_premiado', '<>', NULL)->where('status', '<>', '0')->orderBy('data_vinculada', 'desc')->get();
        foreach ($dados as $dado){
            $user = User::where('twitch_id', '=', $dado->twitch_id_premiado)->first();
            $moderador = User::where('id', '=', $dado->mod_autorizou)->first();
            $data = Carbon::now()->diffInMinutes($dado->data_vinculada) . ' minutos atrás';
            if($data >= 60){
                $data = Carbon::now()->diffInHours($dado->data_vinculada) . ' horas atrás';

                if($data >= 24){
                    $data = $dado->data_vinculada;
                }
            }
            if(isset($user) AND $user->id != null){
                $return[] = [
                    'avatar' => $user->avatar, // user
                    'name' => $user->nick, // user
                    'registred' => $user->created_at, // user
                    'status' => $dado->status, // premios
                    'vinculado_por' => $moderador->nick, // premios
                    'vinculado_data' => $data, // premios
                    'retirado' => $dado->retirado_por, // premios
                    'retirado_data' => $dado->data_retirada // premios
                ];
            }else{
                $return[] = [
                    'avatar' => null, // user
                    'name' => $dado->nick_premiado, // user
                    'registred' => 'Não Registrado', // user
                    'status' => $dado->status, // premios
                    'vinculado_por' => $moderador->nick, // premios
                    'vinculado_data' => $data, // premios
                    'retirado' => $dado->retirado_por, // premios
                    'retirado_data' => $dado->data_retirada // premios
                ];
            }
        }
        return view('site.premios.dashboard')->with(['dados' => $return]);
    }

    public function verificarEmail(request $request){
        $user = Auth::user();
        $verificar_user = User::where('twitch_id', '=', $user->twitch_id)->where('email', '=', $request->email)->first();
        if(isset($verificar_user)){
            $premio = RetirarPremio::where('twitch_id_premiado', '=', $verificar_user->twitch_id)->where('id', '=', $request->premio_id)->first();
            $premio->retirado_por = $user->id;
            $premio->data_retirada = Carbon::now();
            $premio->status = 2;
            $premio->update();
            return response()->json(['status' => 'OK', 'codigo' => $premio->book_code]);
        }else{
            return response()->json(['status' => 'erro', 'msg' => 'Email Invalido']);
        }
    }
}
