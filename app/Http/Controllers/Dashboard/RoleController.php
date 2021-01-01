<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_roles'])->only('index');
        $this->middleware(['permission:create_roles'])->only('create');
        $this->middleware(['permission:delete_roles'])->only('destroy');
        $this->middleware(['permission:update_roles'])->only('edit');

    }

    public function index()
    {
        $roles=Role::WhereRoleNot(['super_admin' , 'admin' , 'user'])
            ->WhenSearch(request()->search)
            ->with('permissions')
            ->withcount('users')
            ->paginate(5);
        return view('dashboard.roles.index' , compact('roles'));
    }


    public function create()
    {
        return view('dashboard.roles.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles,name' ,
            'persmissions'=>'required|array|min:1'
        ]);

       $role= Role::create($request->all());
       $role->attachPermissions($request->persmissions);
        session()->flash('Added','Data Added Successfully');
        return redirect()->route('dashboard.roles.index');
    }

    public function show(Role $category)
    {
        //
    }


    public function edit(Role $role)
    {
        return view('dashboard.roles.edit',compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required|unique:roles,name,'.$role->id,
            'persmissions'=>'required|array|min:1'
        ]);

        $role->update($request->all());
        $role->syncPermissions($request->persmissions);

        session()->flash('Added','Data Updated Successfully');
        return redirect()->route('dashboard.roles.index');

    }


    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('Added','Data Removed Successfully');
        return redirect()->back();

    }
}
