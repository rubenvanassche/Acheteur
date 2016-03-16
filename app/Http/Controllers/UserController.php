<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['getLogin','postLogin']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        $users = User::all();

        return view('acheteur/user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(){
        return view('acheteur/user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateUserRequest $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect(action('UserController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){
        $user = User::findOrFail($id);
        return view('acheteur/user/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(EditUserRequest $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        if($user->password != ''){
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->save();



        return redirect(action('UserController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(action('UserController@index'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function delete($id){

        return view('acheteur/user/delete', compact('id'));
    }

    public function getLogin(){
        return view('acheteur/user/login');
    }

    public function postLogin(LoginUserRequest $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(action('EventController@index'));
        }

        redirect(action('UserController@getLogin'));
    }

    public function getLogout(){
        Auth::logout();

        redirect(action('UserController@getLogin'));
    }
}
