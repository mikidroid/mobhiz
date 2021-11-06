<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\RegisterProduct;
use App\Models\trademark;
use App\Models\businessName;
use App\Models\replaceCert;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(Request $request){
        if(Auth::user()->username!="admin"){
        $trademark=User::find(Auth::user()->id)->trademark->count();
        $businessName=User::find(Auth::user()->id)->businessName->count();
        $replaceCert=User::find(Auth::user()->id)->replaceCert->count();
        $registerProduct=User::find(Auth::user()->id)->registerProduct->count();
        $input=[
          'trademark'=>$trademark,
          'businessName'=>$businessName,
          'replaceCert'=>$replaceCert,
          'registerProduct'=>$registerProduct
          ];
        return response()->json($input);
        }
        
        $trademark=trademark::all()->count();
        $businessName=businessName::all()->count();
        $replaceCert=replaceCert::all()->count();
        $registerProduct=RegisterProduct::all()->count();
        $input=[
          'trademark'=>$trademark,
          'businessName'=>$businessName,
          'replaceCert'=>$replaceCert,
          'registerProduct'=>$registerProduct
          ];
        return response()->json($input);
    }
}
