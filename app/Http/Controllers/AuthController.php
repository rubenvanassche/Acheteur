<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends AppController
{
    public function login(){
        $eventName = Configuration::event()->name;

        return view('auth.login', compact('eventName'));
    }

    public function checkLogin(Requests\Auth\LoginRequest $request){
        if(Configuration::login($request->password)){
            return redirect(action('DashboardController@index'));
        }else{
            return redirect(action('AuthController@login'));
        }
    }

    public function logout(){
        Configuration::logout();

        return redirect(action('AuthController@login'));
    }
}
