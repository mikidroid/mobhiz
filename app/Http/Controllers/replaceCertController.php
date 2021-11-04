<?php

namespace App\Http\Controllers;
use App\Models\order;
use App\Models\User;
use App\Models\replaceCert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class replaceCertController extends Controller
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
        $replaceCertReg=User::find(Auth::user()->id)->replaceCert()->orderBy('id','desc')->get();
        return response()->json($replaceCertReg);
        }
        $replaceCertReg=replaceCert::orderBy('id','desc')->where('payment','=','completed')->get();
        return response()->json($replaceCertReg);
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
    // ini_set('upload_max_filesize', '5M')
    $documents= $request->documents->getClientOriginalName();
     $this->path=time().'-'.$documents;
     $store=$request->documents
       ->storeAs('public/register-replaceCert',$this->path);
    
     $replaceC=replaceCert::create(
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
     if($replaceC){
        $newreplaceCert=replaceCert::latest('id')->where('user_id','=',Auth::user()->id)->first();
        $inputOrder=[
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::user()->firstname.' '.Auth::user()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'payment'=>'pending'
      ,'status'=>1 //Order created is = 1
      ,'type'=>'certificate replacement'
      ,'product_names'=>$request->product_names
      ,'ref_id'=>$request->ref_id
      ,'replace_cert_id'=>$newreplaceCert->id
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
     $viewreplaceCert=replaceCert::find($id);
        return response()->json($viewreplaceCert);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $editreplaceCert=replaceCert::find($id);
        return response()->json($editreplaceCert);
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
      $updatereplaceCert=replaceCert::find($id);
      $newDoc="";
      $oldDoc=$updatereplaceCert->documents;
      
      if(isset($request->documents)){
        if(file_exists('storage/register-replaceCert/'.$oldDoc)){
          unlink('storage/register-replaceCert/'.$oldDoc);}
        $newDoc=$request->documents->getClientOriginalName();
        $newDoc=time().'-'.$newDoc;
        $request->documents->storeAs('public/register-replaceCert',$newDoc);
      }
      else{$newDoc=$oldDoc;}
      
      $updatereplaceCert=replaceCert::find($id)->update(
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
     if($updatereplaceCert){
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
        $myreplaceCert=User::find(Auth::user()->id)->replaceCert()->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($myreplaceCert);
        }
        $myreplaceCert=replaceCert::where('payment','=','completed')->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($myreplaceCert);
    }
}
