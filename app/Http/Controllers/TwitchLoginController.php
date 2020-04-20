<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class TwitchLoginController extends Controller
{
    public function loginTwitch(){
        return Socialite::with('twitch')->redirect();
    }

    public function loginTwitchCallback(){
        try {

            $user = Socialite::driver('twitch')->user();

            $twitch_user = User::where('twitch_id', $user->id)->first();

            if($twitch_user){

                Auth::login($twitch_user);

                return redirect('/receber-premio');

            }else{
                $criarUser = User::create([
                    'name' => $user->name,
                    'nick' => $user->name,
                    'email' => $user->email,
                    'twitch_id'=> $user->id,
                    'avatar' => $user->avatar
                ]);

                Auth::login($criarUser);

                return redirect('/receber-premio');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
