<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\RegisterProduct;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class registerProductController extends Controller
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
        $prodReg=User::find(Auth::user()->id)->registerProduct()->orderBy('id','desc')->get();
        return response()->json($prodReg);
        }
        $prodReg=RegisterProduct::orderBy('id','desc')->where('payment','=','completed')->get();
        return response()->json($prodReg);
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
       ->storeAs('public/register-product',$this->path);
    $phones=[$request->company_phone1,$request->company_phone2];

     $Product=RegisterProduct::create(
       [
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::user()->firstname.' '.Auth::user()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'company_email'=>$request->company_email
      ,'company_phones'=>$phones
      ,'product_names'=>$request->product_names
      ,'documents'=>$this->path
      ,'type'=>$request->type
     ]);
     if($Product){
        $newProd=RegisterProduct::latest('id')->where('user_id','=',Auth::user()->id)->first();
        $inputOrder=[
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::user()->firstname.' '.Auth::user()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'payment'=>'pending'
      ,'mode'=>'not running'
      ,'product_names'=>$request->product_names
      ,'status'=>'Order created'
      ,'type'=>'product registration'
      ,'ref_id'=>$request->ref_id
      ,'register_product_id'=>$newProd->id
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
     $viewProd=RegisterProduct::find($id);
        return response()->json($viewProd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $editProd=RegisterProduct::find($id);
        return response()->json($editProd);
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
      $updateProd=RegisterProduct::find($id);
      $newDoc="";
      $oldDoc=$updateProd->documents;
      
      if(isset($request->documents)){
        if(file_exists('storage/register-product/'.$oldDoc)){
          unlink('storage/register-product/'.$oldDoc);}
        $newDoc=$request->documents->getClientOriginalName();
        $newDoc=time().'-'.$newDoc;
        $request->documents->storeAs('public/register-product',$newDoc);
      }
      else{$newDoc=$oldDoc;}
      
      $phones=[$request->company_phone1,$request->company_phone2];
      $updateProduct=RegisterProduct::find($id)->update(
       [
      'user_id'=>Auth::user()->id
      ,'fullname'=>Auth::User()->firstname.' '.Auth::User()->lastname
      ,'email'=>Auth::user()->email
      ,'phone'=>$request->phone
      ,'company_name'=>$request->company_name
      ,'company_address'=>$request->company_address
      ,'company_email'=>$request->company_email
      ,'company_phones'=>$phones
      ,'product_names'=>$request->product_names
      ,'documents'=>$newDoc
      ,'type'=>$request->type
     ]);
     if($updateProduct){
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
      $myProduct=RegisterProduct::find($id);
      $path=$myProduct->documents;
      if(file_exists('storage/register-product/'.$path)){
       unlink('storage/register-product/'.$path);}
        $myProduct->delete();
         if($myProduct=RegisterProduct::orderBy('id','desc')->get()){
          return response()->json($myProduct);
         }
    }
public function search($val)
    {
      if(Auth::user()->username!="admin"){
        $myProduct=User::find(Auth::user()->id)->registerProduct()->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($myProduct);
        }
        $myProduct=RegisterProduct::where('payment','=','completed')->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($myProduct);
    }
}
