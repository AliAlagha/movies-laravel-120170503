<?php

namespace App\Http\Controllers\Dashboard;
use App\Role;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use function Sodium\add;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:delete_users'])->only('destroy');
        $this->middleware(['permission:update_users'])->only('edit');
    }

    public function index()
    {
        $users=User::WhereRoleNot('super_admin')->WhereSearch(request()->search)->WhenRoleIs(request()->role_id)->with('roles')->paginate(5);
         $roles=Role::WhereRoleNot(['super_admin' , 'user' , 'admin'])->get();
        return view('dashboard.users.index' , compact('users' , 'roles'));
    }


    public function create()
    {
        $roles=Role::whereRoleNot(['super_admin' , 'admin' , 'user'])->get();
        return view('dashboard.users.create' , compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:users,name' ,
            'email'=>'required|min:1|unique:users,email' ,
            'password'=>'required|min:8|unique:users,password| confirmed',
           'roles_id'=>'required'
        ]);
        $request_data=$request->all();
        $request_data['password']=bcrypt($request->password);

        $role= User::create($request_data);
        $role->attachRoles( ['admin' , $request->roles_id] );
        session()->flash('Added','Data Added Successfully');
        return redirect()->route('dashboard.users.index');
    }

    public function show(User $user)
    {

    }


    public function edit(User $user , Role $roles)
    {
        $roles=Role::whereRoleNot(['super_admin' , 'admin' , 'user'])->get();
        return view('dashboard.users.edit',compact('user' , 'roles'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required|unique:users,name,'.$user->id,
            'email'=>'required|min:1|unique:users,email,'.$user->id ,
            'roles_id'=>'required'
        ]);
        $user->update($request->all());
        $user->syncRoles(['admin',$request->roles_id]);

        session()->flash('Added','Data Updated Successfully');
        return redirect()->route('dashboard.users.index');

    }


    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('Added','Data Removed Successfully');
        return redirect()->back();

    }
}
