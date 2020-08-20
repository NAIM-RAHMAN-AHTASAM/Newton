<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleController extends Controller
{
  function index(){
    // $permission = Permission::create(['name' => 'see role manage']);


    return view('admin.role.index',[
      'roles' =>Role::all(),
      'permissions' =>Permission::all(),
      'users' =>User::where('role',1)->get(),
    ]);


  }


  function roleadd(Request $request){
    $request->validate([
      'role_name'=>'unique:roles,name',
    ]);
    $role = Role::create(['name' => $request->role_name]);
    $role->givePermissionTo($request->permission);
    // $role->syncPermissions();
    return back();

    // to check
    // echo $request->role_name;
    // print_r($request->permission);

  }

  function roleassign(Request $request){
  print_r($request->all());
  $user = User::find($request->user_id);
  $user->assignRole($request->role_name);
  return back();


  }
  function rolepermissionedit($user_id){

  return view('admin.role.edit',[
    'permissions' =>Permission::all(),
    'users' =>User::find($user_id),
  ]);


  }
  function rolepermissioneditpost(Request $request){
 print_r($request->all());
 $user = User::find($request->user_id);
 $user->syncPermissions($request->permission);
 return back();


  }




}
