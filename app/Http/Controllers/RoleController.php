<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  //    $roles = Role::all();
      return view('role/index',['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('role/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!isset($request->name) ){
        return view('layouts.results', [
          'redirect' => '/roles',
          'msg'=>'Role information missing',
          'status'=>'error'
        ]);
      }

      $role = new Role();
      $role->name = $request->name;
      $role->save();

      return view('layouts.results', [
        'redirect' => '/roles',
        'msg'=>'New Role Added',
        'status'=>'success'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
      return view('layouts.show', [
        'title'=>'Role',
        'model' => Role::find($role->id)
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('role/edit', ['role' => Role::find($role->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
      if(!isset($request->name) ){
        return view('layouts.results', [
          'redirect' => '/roles',
          'msg'=>'Table information missing',
          'status'=>'error'
        ]);
      }
      $role = Role::find($role->id);
      $role->name =  $request->name;
      $result = $role->save();

      if($result){
        return view('layouts.results', [
          'redirect' => '/roles',
          'msg'=>'Role Updated: ' . $role->name,
          'status'=>'success'
        ]);
      }else{
        return view('layouts.results', [
          'redirect' => '/roles',
          'msg'=>'Update Failed',
          'status'=>'error'
        ]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
      $role = Role::find($role->id);
      $result = Role::destroy($role->id);
      if($result){
        return view('layouts.results', [
          'redirect' => '/roles',
          'msg'=>'Role Deleted: ' . $role->name,
          'status'=>'success'
        ]);
      }else{
        return view('layouts.results', [
          'redirect' => '/roles',
          'msg'=>'Deletion failed',
          'status'=>'error'
        ]);
      }
    }
}
