<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::latest('id')->get();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $user=User::find($id);
       $oldPic=$user->profile_pic;
       $profile_pic="";
       //Check if user uploaded photo
        if(isset($request->profile_pic)){
          //Check if there is file there already and delete if there is
          if(file_exists('storage/profile-pics/'.$oldPic)){
            unlink('storage/profile-pics/'.$oldPic);}
          $pic=$request->profile_pic->getClientOriginalName();
          $path=time().'-'.$pic;
          $request->profile_pic->storeAs('public/profile-pics',$path);
          $profile_pic=$path;}
          else{$profile_pic=$oldPic;}
        //Update user
        $userUpdate=$user->update([
          'firstname'=>$request->firstname,
          'lastname'=>$request->lastname,
          'username'=>$request->username,
          'email'=>$request->email,
          'phone'=>$request->phone,
          'country'=>$request->country,
          'city'=>$request->city,
          'gender'=>$request->gender,
          'profile_pic'=>$profile_pic,
          ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
    }
    
public function search($val)
    {
      
        $myUser=User::where('firstname','LIKE',"%$val%")->orWhere('lastname','LIKE',"%$val%")->orWhere('username','LIKE',"%$val%")->orWhere('email','LIKE',"%$val%")->latest()->get();
        return response()->json($myUser);
    }
}
