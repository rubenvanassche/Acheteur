<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Email;
use App\Event;
use App\Http\Requests\Preference\EditEmailRequest;
use App\Http\Requests\Preference\EditGeneralRequest;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class PreferencesController extends AppController
{

    public function __construct(){
        Parent::__construct();
        $this->middleware('isAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('preferences/index');
    }

    public function emails(){
        $emails = Email::all();

        return view('preferences/emails', compact('emails'));
    }

    public function editGeneral(){
        $event = Event::where('id', Configuration::eventId())->first();
        $pages = Page::where('event_id', Configuration::eventId())->lists('title', 'id');


        return view('preferences/editGeneral', compact('event', 'pages'));
    }

    public function updateGeneral(EditGeneralRequest $request){
        $event = Event::where('id', Configuration::eventId())->first();
        $event->name = $request->name;
        $event->email = $request->email;
        $event->after_order_page_id = $request->afterOrderPage;
        $event->shifts = ($request->shifts === '1' ? 1 : 0);
        $event->save();

        Flash::success('Preferences changed!');

        return redirect(action('PreferencesController@editGeneral'));
    }

    public function editEmail($type){
        $emailTemplate = Email::viewPath($type);
        $code = Storage::get($emailTemplate);

        return view('preferences/editEmail', compact('code', 'type'));
    }

    public function updateEmail(EditEmailRequest $request, $type){
        $emailTemplate = Email::viewPath($type);
        Storage::put($emailTemplate, $request->code);


        return redirect(action('PreferencesController@emails'));
    }

    public function about(){
        return view('preferences/about');
    }


    public function license(){
        return view('preferences/license');
    }



}
