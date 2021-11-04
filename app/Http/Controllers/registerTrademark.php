<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\trademark;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class registerTrademark extends Controller
{
 public $path=null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->username!="admin"){
        $trademarkReg=User::find(Auth::user()->id)->trademark()->orderBy('id','desc')->get();
        return response()->json($trademarkReg);
        }
        $trademarkReg=trademark::orderBy('id','desc')->where('payment','=','completed')->get();
        return response()->json($trademarkReg);
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
    // ini_set('upload_max_filesize', '5M');

    $documents= $request->documents->getClientOriginalName();
     $this->path=time().'-'.$documents;
     $store=$request->documents
       ->storeAs('public/register-trademark',$this->path);
    
     $trademark=trademark::create(
       [
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::user()->firstname.' '.Auth::user()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'product_names'=>$request->product_names
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'documents'=>$this->path
     ]);
     if($trademark){
        $newtrademark=trademark::latest('id')->where('user_id','=',Auth::user()->id)->first();
        $inputOrder=[
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::user()->firstname.' '.Auth::user()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'payment'=>'pending'
      ,'status'=>1 //Order created is = 1
      ,'type'=>'trademark registration'
      ,'product_names'=>$request->product_names
      ,'ref_id'=>$request->ref_id
      ,'trademark_id'=>$newtrademark->id
     ];
        $newOrder=order::create($inputOrder);
     }
     
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $viewtrademark=trademark::find($id);
        return response()->json($viewtrademark);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $edittrademark=trademark::find($id);
        return response()->json($edittrademark);
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
      $updatetrademark=trademark::find($id);
      $newDoc="";
      $oldDoc=$updatetrademark->documents;
      
      if(isset($request->documents)){
        if(file_exists('storage/register-trademark/'.$oldDoc)){
          unlink('storage/register-trademark/'.$oldDoc);}
        $newDoc=$request->documents->getClientOriginalName();
        $newDoc=time().'-'.$newDoc;
        $request->documents->storeAs('public/register-trademark',$newDoc);
      }
      else{$newDoc=$oldDoc;}
      
      $updatetrademark=trademark::find($id)->update(
       [
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::User()->firstname.' '.Auth::User()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'product_names'=>$request->product_names
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'documents'=>$newDoc
     ]);
     if($updatetrademark){
      return response('Done');
     }
     
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
public function search($val)
    {
      if(Auth::user()->username!="admin"){
        $mytrademark=User::find(Auth::user()->id)->trademark()->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($mytrademark);
        }
        $mytrademark=trademark::where('payment','=','completed')->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($mytrademark);
    }
}
