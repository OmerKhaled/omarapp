<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;



class userController extends Controller
{
    public function __construct(){

        
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::WhereRoleIs("admin")->latest()->paginate(5);
        return view("dashboard.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.users.create");
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
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'  => 'required|unique:users,email',
            'password'  => 'required|confirmed',
            'img'       => 'image'
        ]);
       //get request data 
        $request_data = $request->except(['password','password_confirmed', 'premission','img']);
        $request_data["password"] = bcrypt($request->password);
        //check if img info exists ? 
        if($request->img){

            Image::make($request->img)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("uploadImage/usersImage/". $request->img->hashName() ));
            $request_data['img'] = $request->img->hashName();

        }//end of image request
        /// create admin user
        $user = User::create($request_data);
        //give admin permissions
        $user->attachRole("admin");
        $user->syncPermissions($request->permission);
        //send flash message it's success
        session()->flash('success', __("User Is Create"));
        //back to users list
        return redirect("/dashboard/users/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view("dashboard.users.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'  => 'required',
            'img'       => 'image'
            

        ]);
       
        $request_data = $request->except(['premission','img']);
        
        //check if img info exists ? 
        if($request->img){
            //delete old image if not a def image
        
            
            //optmize and store new image
            Image::make($request->img)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("uploadImage/usersImage/". $request->img->hashName() ));
            $request_data['img'] = $request->img->hashName();

        }//end of image request

        $user->update($request_data);
        $user->syncPermissions($request->permission);
       
        session()->flash('success', __("User Is Updated"));

       return redirect("/dashboard/users/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        //delete user image first 
        if($user->img != 'def.png'){
            Storage::disk('public_upload')->delete('/usersImage/'. $user->img);
        }
        $user->delete();
        session()->flash("success", __("User Is Deleted"));
        return redirect(Route("users.index"));
    
    }
}
