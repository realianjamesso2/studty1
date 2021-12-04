<?php

namespace MakeEasySolutions\AccountPart\Http\Controllers; 

use MakeEasySolutions\AccountPart\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; 

class RolePermissionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $roles = Role::with('permissions:id');
        return response()->json($roles->get()->toArray());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Permission $permission,Request $request)
    {
       // $this->setTokenExpire();
       
        $method = request('isChecked') ?  'givePermissionTo' : 'revokePermissionTo';

        $role->{$method}($permission);
        $data = ['role' => $role,
                      'permission' => $permission
                    ];
        $description = $method;
        return response()->json($role);
    }
    
}
