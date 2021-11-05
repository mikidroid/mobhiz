<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class projectController extends Controller
{
    /**
 public $path=null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectReg=project::orderBy('id','desc')->get();
        return response()->json($projectReg);
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

    $image=$request->image->getClientOriginalName();
     $this->path=time().'-'.$image;
     $store=$request->image
       ->storeAs('public/project',$this->path);
     $project=project::create([
      'user_id'=>Auth::user()->id
      ,'title'=>$request->title
      ,'client'=>$request->client
      ,'details'=>$request->details
      ,'duration'=>$request->duration
      ,'image'=>$this->path
     ]);
     if($project){
        return response("done");
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
     $viewproject=project::find($id);
        return response()->json($viewproject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $editproject=project::find($id);
        return response()->json($editproject);
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
      $updateproject=project::find($id);
      $newDoc="";
      $oldDoc=$updateproject->image;
      
      if(isset($request->image)){
        if(file_exists('storage/project/'.$oldDoc)){
          unlink('storage/project/'.$oldDoc);}
        $newDoc=$request->image->getClientOriginalName();
        $newDoc=time().'-'.$newDoc;
        $request->image->storeAs('public/project',$newDoc);
      }
      else{$newDoc=$oldDoc;}
      
      $updateproject=project::find($id)->update(
       [
      'user_id'=>Auth::user()->id
      ,'title'=>$request->title
      ,'client'=>$request->client
      ,'details'=>$request->details
      ,'duration'=>$request->duration
      ,'image'=>$newDoc
     ]);
     if($updateproject){
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
      $deleteProject=project::find($id);
      $oldImage=$deleteProject->image;
        if(file_exists('storage/project/'.$oldImage)){
          unlink('storage/project/'.$oldImage);}
        if($deleteProject->delete()){
          return response("done");
        }
    }
    
public function search($val)
    {
      if(Auth::user()->username!="admin"){
        $myproject=User::find(Auth::user()->id)->project()->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($myproject);
        }
        $myproject=project::where('payment','=','completed')->where('fullname','LIKE',"%$val%")->latest()->get();
        return response()->json($myproject);
    }
}
