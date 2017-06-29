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
        $now = date('Y-m-d H:i:s');  
        $notices = Notice::get()->where('published_on',!NULL)->where('expire_at','>',$now)->sortByDesc('updated_at');
        foreach($notices as $notice){
            $user_id= $notice->user_id;
            $notice->name = User::where('id',$user_id)->first()->name;
            
        }
        return view('Admin.home',['notices' => $notices ]);
    }

    public function add_notice()
    {
        return view('Admin.add_notice');
    }

    public function view_my_notice()
    {
        $user_id = Auth::user()->id;
        $name = Auth::user()->name;
        $now = date('Y-m-d H:i:s');  
        $notices = Notice::get()->where('user_id',$user_id)->sortByDesc('updated_at'); 
        return view('Admin.view_notice',['notices' => $notices, 'name' => $name,'user_id' => $user_id,'current_time' => $now]);
    }

    public function view_old_notices()
    {
        $notices = Notice::all()->where('published_on',! NULL)->sortByDesc('updated_at');
        return view('Admin.view_old_notices',['notices' => $notices]);
    }

    public function view_new_notices()
    {
        $notices = Notice::all()->where('published_on',"")->sortByDesc('updated_at');
        return view('Admin.view_new_notices',['notices' => $notices]);
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

    public function edit_my_notice($id)
    {
        $notices = Notice::all()->where('id',$id); 
        $user_id = Notice::where('id', $id)->first()->user_id;
        $created_user = User::where('id',$user_id)->first()->name;
        $logged_in_user = Auth::user()->name;
        return view('Admin.edit_notice',['notices' => $notices , 'created_user' => $created_user , 'logged_in_user' => $logged_in_user]);
    }

    public function delete_notice($id)
    {
        $notice = Notice::find($id);
        $notice->delete();
        return redirect('/');
    }

    public function publish_notice($id)
    {
        $notice = Notice::find($id);
        $notice->published_on = date('Y-m-d H:i:s'); 
        $notice->save();
    
        return redirect('adminaccount')->with('status','New notice published');
    }

    public function show_single_notice($id)
    {
         $notices = Notice::all()->where('id',$id); 
         $user_id = Notice::where('id', $id)->first()->user_id;
         $name = User::where('id',$user_id)->first()->name;
         return view('Admin.show_single_notice',['notices' => $notices, 'name' => $name]);
    }

    public function edit_single_notice($id)
    {
        $notices = Notice::all()->where('id',$id); 
        $user_id = Notice::where('id', $id)->first()->user_id;
        $created_user = User::where('id',$user_id)->first()->name;
        $logged_in_user = Auth::user()->name;
        return view('Admin.edit_notice',['notices' => $notices , 'created_user' => $created_user ,'logged_in_user' => $logged_in_user]);
    }

    public function update_single_notice(Request $request)
    {
        $notice_id=$request->id;
        $user_id = Notice::where('id', $notice_id)->first()->user_id; 
        $created_user = User::where('id',$user_id)->first()->name; 
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
        return redirect('adminaccount')->with('Status',$created_user." 's notice edited successfully ");
    }

    public function update_my_notice(Request $request)
    {
        $sec =  strtotime($request['expire_at'])  - strtotime(date('Y-m-d H:i:s'));  
        if($sec> 0){
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
            return redirect('/')->with('Status','Your Notice is updated');
        } else {
            return redirect('/')->with('status','Please select a time in future as expiry date');
        }           
    }
}
