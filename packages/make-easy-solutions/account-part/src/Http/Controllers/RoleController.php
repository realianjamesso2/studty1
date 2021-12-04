<?php

namespace MakeEasySolutions\AccountPart\Http\Controllers; 

use MakeEasySolutions\AccountPart\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Laravel\Passport\Passport;
use Illuminate\Support\Carbon;


class RoleController extends Controller
{
 
  

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return Role::all();  
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
            'name' => 'required|unique:roles',
        ]);

        $role = Role::create(request()->all()); 
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return $role;
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         
        request()->validate([
            'name' => 'required|unique:roles,name,' . $request->id . ',id',
        ]);

        $role = Role::find($request->id);
        
         
        $role -> name = $request->name;
        $role->save();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role =Role::find($id); 
        $role->delete();
        return $this->index();
    }

    /**
     * Multiple Delete
     */
 
}
