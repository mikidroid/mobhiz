<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\businessName;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class registerBusiness extends Controller
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
        $businessReg=User::find(Auth::user()->id)->businessName()->orderBy('id','desc')->get();
        return response()->json($businessReg);
        }
        $businessReg=businessName::orderBy('id','desc')->where('payment','=','completed')->get();
        return response()->json($businessReg);
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
       ->storeAs('public/register-business',$this->path);
    
     $business=businessName::create(
       [
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::user()->firstname.' '.Auth::user()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'documents'=>$this->path
     ]);
     if($business){
        $newbusiness=businessName::latest('id')->where('user_id','=',Auth::user()->id)->first();
        $inputOrder=[
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::user()->firstname.' '.Auth::user()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'payment'=>'pending'
      ,'status'=>1 //Order created is = 1
      ,'type'=>'cac registration'
      ,'ref_id'=>$request->ref_id
      ,'business_name_id'=>$newbusiness->id
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
     $viewbusiness=businessName::find($id);
        return response()->json($viewbusiness);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $editbusiness=Registerbusinessuct::find($id);
        return response()->json($editbusiness);
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
      $updatebusiness=businessName::find($id);
      $newDoc="";
      $oldDoc=$updatebusiness->documents;
      
      if(isset($request->documents)){
        if(file_exists('storage/register-business/'.$oldDoc)){
          unlink('storage/register-business/'.$oldDoc);}
        $newDoc=$request->documents->getClientOriginalName();
        $newDoc=time().'-'.$newDoc;
        $request->documents->storeAs('public/register-business',$newDoc);
      }
      else{$newDoc=$oldDoc;}
      
      $updateBusinessName=businessName::find($id)->update(
       [
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::User()->firstname.' '.Auth::User()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'documents'=>$newDoc
     ]);
     if($updateBusinessName){
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
        $mybusiness=User::find(Auth::user()->id)->businessName()->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($mybusiness);
        }
        $mybusiness=businessName::where('payment','=','completed')->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($mybusiness);
    }
}
