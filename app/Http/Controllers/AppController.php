<?php

namespace App\Http\Controllers;


use App\Configuration;
use App\Event;

abstract class AppController extends Controller{
    var $event;

    public function __construct(){
        $this->event = Configuration::event();
        view()->share('event', $this->event);
    }
}
