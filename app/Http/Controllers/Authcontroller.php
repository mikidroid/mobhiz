<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class Authcontroller extends Controller
{
    //
    public function register(Request $request){
       
       $request->validate([
        'firstname'=>'required',
        'username'=>'required|unique:users',
        'email'=>'required|email|unique:users'
        ]);
       
        $createUser = User::create([
         'firstname'=>$request->firstname,
         'lastname'=>$request->lastname,
         'username'=>$request->username,
         'email'=>$request->email,
         'password'=>Hash::make($request->password),
         ]);
        if($createUser){
         return response(['success'=>'Registered successfully']);
        }
        else{
         return response(['error'=>'Failed to register']);
        }
        
    }
    
    
public function login(Request $request){
     $request->validate([
        'email'=>'required|email',
        'password'=>'required',
        ]);
     $user=User::where('email',$request->email)->first();
        if(!$user||!Hash::check($request->password,$user->password)){
           throw ValidationException::withMessages([
            'incorrect' => 'The provided credentials are incorrect.']);}
     $token=$user->createToken('browser');
     return response()->json(['success'=>'Login successful',
       'token'=>$token->plainTextToken]);}
       
public function updateUser(Request $request){
      $request->validate([
        'firstname'=>'required',
        'lastname'=>'required',
        'username'=>'required|unique:users',
        'email'=>'required|email|unique:users'
        ]);
      $updateUser=User::update([
        'firstname'=>$request->firstname,
        'lastname'=>$request->lastname,
        'username'=>$request->username,
        'email'=>$request->email,
        'age'=>$request->age,
        'country'=>$request->country,
        'city'=>$request->city,
      ]); }
    
public function logout(Request $request){
         $request->user()->tokens()->delete();
        }
        
    
}
