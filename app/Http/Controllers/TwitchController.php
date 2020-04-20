<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TwitchController extends Controller
{
    public $headers = ['Accept' => 'application/vnd.twitchtv.v5+json', 'Client-ID' => 'pnpon37g6pl0bhnnnt83sq8st0jvs7'];
    public $canal_buscado = null;

    public function getInformacoesCanal($canais){
        $url = 'https://api.twitch.tv/kraken/users?api_version=5&login=' . $canais;
        $infos = Http::withHeaders($this->headers)->get($url);

        if($infos->json()['_total'] >= 1){
            $canais = $infos->json()['users'];
            // dd($canais);
            $return = ['status' => 'success'];
            $stream = false;
            foreach ($canais as $canal){
                $online = $this->verificaOnline($canal['_id']);
                if(!isset($online) or $online == null){
                    $online = false;
                    $live = false;
                }else{
                    $live = true;
                    $stream = $online->original;
                }
                $return[] = [
                    'live' => $live,
                    'canal' => $canal['display_name'],
                    'canal_id' => $canal['_id'],
                    'bio' => $canal['bio'],
                    'logo' => $canal['logo'],
                    'stream' => $stream
                ];
            }
            return $return;
        }else{
            return ['status' => 'erro', 'err_cod' => '10001', 'msg' => 'Nenhum canal encontrado'];
        }
        // return ($infos->json()['users']);
    }

    public function verificaOnline($id_canal){
        $url = 'https://api.twitch.tv/kraken/streams/' . $id_canal;
        $infos = Http::withHeaders($this->headers)->get($url);
        $data = $infos->json()['stream'];
        if($data != null){
            return response($data);
        }else{
            return;
        }
    }
}
