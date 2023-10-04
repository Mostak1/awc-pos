<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
   
    public function index()
    {

        $roles= Role::get();
        $items= UserRole::with(['role','user'])->get();
        // return view('user.role', compact('roles','items'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.rolecreate');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roleData  = [
            'role_name'=>$request->role_name,
            'is_active'=>false,

        ];
        $role = Role::create($roleData);
        if($role){
            return view('user.role')->with('success','Role created successfully');
        }else{
            return view('user.role')->with('error','Role created Failed');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
      
        return response()->json([
            'data'=> $role
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('user.roleedit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $roleData  = [
            'role_name'=>$request->role_name,
            'is_active'=>false,

        ];
        $role = $role->update($roleData);
        if($role){
            return view('user.role')->with('success','Role Update successfully');
        }else{
            return view('user.role')->with('error','Role Update Failed');

        }
    }
    
    public function destroy(Role $role)
    {
        if (Role::destroy($role->id)) {
            return response()->json([
                'info' =>  $role->id . ' Deleted!',
               
            ]);
        }
    }
}
