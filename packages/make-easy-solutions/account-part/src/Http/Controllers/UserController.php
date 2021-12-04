<?php

namespace MakeEasySolutions\AccountPart\Http\Controllers; 

use MakeEasySolutions\AccountPart\Http\Controllers\Controller; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
 

    
     
    public function index()
    {
        return response([
            'roles'=>Role::all(),
        ],200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required|',
            'password' => 'required'
        ]);

      
         $user  = new User;
         $user -> name = $request->name;
         $user -> email = $request->email;
         $user -> password =Hash::make($request->password);
         $user -> save();

         $user->assignRole($request->role);
        //  return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->with('roles')->first();
        return response(['user'=>$user,'roles'=>Role::all()], 200);
    }
    
    public function getUserdata($data)
    {
       
            $user = User::find($apikey->user_id);
            return $user;
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $user = User::find($request->id);
      
       $user -> name = $request->name;
       $user -> email = $request->email;
       $user -> save();

       $user->syncRoles($request->role);
       //return $request->role;
       return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return $this->index();
    }
    
   
}
