<?php

namespace App;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Configuration{
    public static  $eventModel = "";

    static function eventId(){
        if(\Illuminate\Support\Facades\Request::segment(1) == ""){
            return;
        }

        try {
            return Event::findBySlugOrFail(\Illuminate\Support\Facades\Request::segment(1))->id;
        }catch(Exception $e){
            dd("No event found with slug: ".\Illuminate\Support\Facades\Request::segment(1));
        }
    }

    static function eventSlugs(){
        return Event::all('slug');
    }

    static function event(){
        if(self::$eventModel == "" && is_string(self::$eventModel)){
            if(!App::runningInConsole()){
                self::$eventModel = Event::findBySlugOrFail(\Illuminate\Support\Facades\Request::segment(1));
                return self::$eventModel;
            }
        }else{
            return self::$eventModel;
        }
    }

    // Login someone to the admin
    static function login($password){
        if(Hash::check($password, Event::where('id', Configuration::eventId())->first()->password)){
            Session::put('eventId', Configuration::eventId());
            return true;
        }else{
            return false;
        }
    }

    // Check if someone is logged in
    static function check(){
        if(Session::has('eventId')){
            if(Session::get('eventId') == Configuration::eventId()){
                return true;
            }
        }

        return false;
    }

    // Logout someone
    static function logout(){
        Session::forget('eventId');
    }
}