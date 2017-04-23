<?php

namespace App\Http\Controllers;

//use Faker\Generator;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user/index', ['users'=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create', ['roles'=>Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!isset($request->name) || !isset($request->email) ){
        return view('layouts.results', [
          'redirect' => '/users',
          'msg'=>'User information missing',
          'status'=>'error'
        ]);
      }
      $faker = \Faker\Factory::create();
      $pw = $faker->password;
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($pw);
      $user->save();

      return view('layouts.results', [
        'redirect' => '/users',
        'msg'=>'New User Added.  Password is: ' . $pw,
        'status'=>'success'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view('user/edit', [
        'user'=>User::find($id)->load('roles'),
        'roles'=>Role::all()
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if(!isset($request->name , $request->active) ){
        return view('layouts.results', [
          'redirect' => '/users',
          'msg'=>'User information missing',
          'status'=>'error'
        ]);
      }
      $user = User::find($id);
      $user->name =  $request->name;
      $user->active = $request->active;
      $result = $user->save();

      $user->roles()->sync(Role::find($request->roles));


      if($result){
        return view('layouts.results', [
          'redirect' => '/users',
          'msg'=>'User Updated',
          'status'=>'success'
        ]);
      }else{
        return view('layouts.results', [
          'redirect' => '/users',
          'msg'=>'Update Failed',
          'status'=>'error'
        ]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $user = User::find($id)->load('roles');
      $result = User::destroy($id);
      if($result){
        return view('layouts.results', [
          'redirect' => '/users',
          'msg'=>'User Deleted',
          'status'=>'success'
        ]);
      }else{
        return view('layouts.results', [
          'redirect' => '/users',
          'msg'=>'Deletion failed',
          'status'=>'error'
        ]);
      }
    }
}
