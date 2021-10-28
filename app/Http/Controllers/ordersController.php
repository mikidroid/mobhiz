<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\RegisterProduct;
class ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->username!="admin"){
        $myOrder=User::find(Auth::user()->id)->order()->orderBy('id','desc')->get();
        return response()->json($myOrder);
        }
        $myOrder=order::orderBy('id','desc')->get();
        return response()->json($myOrder);
    }
    
public function sea($val)
    {
        
        return response()->json($myOrder);
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $myOrder=order::find($id);
         return response()->json($myOrder);
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $myOrder=order::find($id);
        $myOrder->delete();
         if($newOrder=order::orderBy('id','desc')->get()){
          return response()->json($newOrder);
         }
    }
    
public function productOrder(Request $request)
    {
        $myOrder=order::where('ref_id','=',$request->ref_id)->first();
        $myOrder->payment='completed';
        $myOrder->status=2; //means payment conplete
        $myOrder->nafdac_status=1;
        //Load RegisterProduct model for relationships
        $regProd=$myOrder->registerProduct;
        $regProd->payment='completed';
        //Save both models
        if($myOrder->save()){
        $regProd->save();}
    }
public function businessNameOrder(Request $request,$value)
    {
        $myOrder=order::where('ref_id','=',$value)->first();
        $myOrder->payment='completed';
        $myOrder->ref_id=$request->new_ref;
        $myOrder->status=2;
        //Load RegisterProduct model for relationships
        $regBis=$myOrder->businessName;
        $regBis->payment='completed';
        //Save both models
        $myOrder->save();
        $regBis->save();
    }
public function trademarkOrder(Request $request,$value)
    {
        $myOrder=order::where('ref_id','=',$value)->first();
        $myOrder->payment='completed';
        $myOrder->ref_id=$request->new_ref;
        $myOrder->status=2;
        //Load RegisterProduct model for relationships
        $regTrad=$myOrder->trademark;
        $regTrad->payment='completed';
        //Save both models
        $myOrder->save();
        $regTrad->save();
    }
public function search(Request $request,$val)
    {
      if(Auth::user()->username!="admin"){
        $myOrder=User::find(Auth::user()->id)->order()->where('fullname','LIKE',"%$val%")->orWhere('ref_id','LIKE',"%$val%")->orWhere('email','LIKE',"%$val%")->latest()->get();
        //Return ($val);
        return response()->json($myOrder);}
        $myOrder=order::where('fullname','like',"%$val%")->orWhere('ref_id','LIKE',"%$val%")->orWhere('email','LIKE',"%$val%") ->latest()->get();
        return response()->json($myOrder);}
}
