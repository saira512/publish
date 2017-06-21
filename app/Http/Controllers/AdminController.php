<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Notice;
use App\Models\Permission;
use Auth;

class AdminController extends Controller
{
    
    public function __construct()
    {
       $this->middleware('auth')->except('index');
    }
    
    public function add_role()
    {
        $roles = Role::all();
        $permissions=Permission::all();
        return view('Admin.add_role',["roles" => $roles, "permissions" => $permissions]);
    }
    
    public function create_role(Request $request)
    {
        //return $request->all();
        $this->validate($request, [
             'title' => 'required|unique:roles',
        ]);

        $role = Role::create([
            'title' => $request['title'],
        ]);

        foreach($request->permission as $request->permission){
        $role->permission()->attach($request->permission);
        }
        return redirect('add_role')->with('Status','New Role Added');
    
    }
    public function index()
    {
        return view('Admin.publish');
    }
    public function add_notice()
    {
        return view('Admin.add_notice');
    }

    public function view_my_notice()
    {
        return view('Admin.view_notice');
    }

    public function view_all_notices()
    {

    }

    public function create_notice(Request $request)
    {
       /*$user_id=Auth::user()->id;
       $this->validate($request, [
             'title' => 'required',
             'content' => 'required|unique:notices',
             'expiry_date' => 'required',
        ]);

        $role = Notice::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'expire_at' => $request['expiry_date'],
             'user_id'  => $user_id,       
         ]);
        return redirect('add_notice')->with('Status','Your Notice Is Submitted To Admin For Approval');*/
    

    }


    public function edit_notice()
    {

    }

    public function delete_notice()
    {

    }
}
