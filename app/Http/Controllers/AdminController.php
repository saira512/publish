<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;
use App\Models\Notice;
use App\Models\Permission;
use Auth;
use dateTime;
use carbon\carbon;
use DateInterval;

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
        $user_id = Auth::user()->id;
        $name = Auth::user()->name;
        $notices = Notice::where('user_id',$user_id)->get(); 
        return view('Admin.view_notice',['notices' => $notices, 'name' => $name]);
    }

    public function view_old_notices()
    {

    }

    public function view_new_notices()
    {

    }

    public function create_notice(Request $request)
    {
       $sec =  strtotime($request['expiry_date'])  - strtotime(date('Y-m-d H:i:s'));  
       if($sec> 0){
           $user_id=Auth::user()->id;
           $request['expiry_date'] =   strtotime($request['expiry_date']);
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
            return redirect('add_notice')->with('Status','Your Notice Is Submitted To Admin For Approval');
        } else {
            return redirect('add_notice')->with('Status','please select a time in future for expiry date and time');
        }                                 
       
    }

    public function edit_notice($id)
    {
       $notices = Notice::all()->where('id',$id); 
       return view('Admin.edit_notice',['notices' => $notices]);
    }

    public function delete_notice($id)
    {

    }
    public function update_notice(Request $request)
    {
         $notice_id=$request->id;
         $user_id=Auth::user()->id;
         $this->validate($request, [
             'title' => 'required',
             'content1' => 'required',
           ]);
         $notice = Notice::find($notice_id);
         $notice->title = $request->title;
         $notice->content = $request->content1;
         $notice->expire_at= $request->expire_at;
         $notice->user_id= $user_id;
         $notice->save();
    
         return redirect('view_my_notice')->with('Status','Your Updated Notice Is Submitted To Admin For Approval');
                   
    }
}
