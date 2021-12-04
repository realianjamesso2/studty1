<?php

namespace MakeEasySolutions\AccountPart\Http\Controllers; 

use MakeEasySolutions\AccountPart\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
 
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Permission::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        request()->validate([
            'name' => 'required|unique:permissions',
        ]);

        $permission = Permission::create(request()->all()); 
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $permission = Permission::find($id);
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate([
            'name' => 'required|unique:permissions,name,' . $request->id.  ',id',
        ]);
        
        $permission = Permission::find($request->id); 
        $permission->name = $request->name;
        $permission->save();
         
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id); 
        $permission->delete();
        return $this->index();
    }

    /**
     * Multiple Delete
     */
    
    
}