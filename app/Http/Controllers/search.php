<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\RegisterProduct;
use Illuminate\Http\Request;

class search extends Controller
{
public function searchOrder(Request $request,$val)
    {
      if(Auth::user()->username!="admin"){
        $myOrder=User::find(Auth::user()->id)->order()->where('fullname','LIKE',"%$val%")->get();
       // return ($val);
        return response()->json($myOrder);
        }
        $myOrder=order::where('fullname','like',"%$val%")->get();
        return response()->json($myOrder);
    }
}
