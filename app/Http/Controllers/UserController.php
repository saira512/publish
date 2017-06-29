<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Notice;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
    
    }
   
    public function create()
    {
        $roles = Role::all();
        return view('Admin.user_register', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|max:255',
        'email' =>'required|email',
        'password' =>'required|confirmed|max:255',
        ]);

        $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => bcrypt($request['password']),
         ]);
         
         
         $user->roles()->attach($request->role);
         return redirect('/')->with('Status','You Are Registered');
    }

    public function login()
    {
        $roles = Role::all();
        return view('Admin.login',['roles' => $roles]);
    }

    public function member_validate(Request $request)
    {
        $this->validate($request, [
             'userrole' => 'required',
             'email' =>'required|email',
             'password' =>'required|max:255',
        ]);
        $credentials=array('email' => $request->email,'password' => $request->password);
       
        if (Auth::attempt($credentials)){
          $user_id=Auth::user()->id;
          $role_info=User::find($user_id)->roles;
          foreach ($role_info as $role_info){
             $role_id=$role_info->id;
             $role_name=$role_info->title;
          }
          $userrole=$request->userrole;
          $userrole_name=Role::find($userrole)->title;
          if($role_id==$userrole){
             return redirect($role_name.'account')->with('Status','You are now Loged in as '.$role_name);
          } else{
              Auth::logout();
              return redirect('login')->with('Status','you are not allowed to login as  '.$userrole_name);
          }
        } else {
             return redirect('login')->with('Status','please try again');
        }
    }

    public function myaccount()
    {
        $user_id=Auth::user()->id;
        $role_info=User::find($user_id)->roles;
        foreach ($role_info as $role_info){
           $role_id=$role_info->id;
           $role_name=$role_info->title;
        }
        return redirect($role_name.'account');
    }
}
