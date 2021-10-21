<?php

namespace App\Http\Controllers;
use App\Models\message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $outbox=$this->outbox();
      $inbox=message::
      where('reciever_username','=',Auth::user()
      ->username)->latest('id')->get();
      return response()->json(['outbox'=>$outbox,'inbox'=>$inbox]);
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
     $file="";
     if($request->file){
      $file=time().'-'.$request->file->getClientOriginalName();
      $request->file->storeAs('public/message',$file);
     }
      $store=message::create([
        'user_id'=>$request->user_id,
        'reciever_username'=>$request->reciever_username,
        'username'=>$request->username,
        'file'=>$file,
        'subject'=>$request->subject,
        'body'=>$request->body,
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message=message::find($id);
        return response()->json($message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mark as read
        $markRead=message::find($id);
        $markRead->read=1;
        $markRead->save();
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
        //
    }
    
    //In
    public function outbox()
    {
        $outbox=User::find(Auth::user()->id)->message()->latest('id')->get();
        return $outbox;
    }

    public function search(Request $request,$val)
    {
        $outbox=User::find(Auth::user()->id)->message()->where('body','LIKE',"%$val%")->latest('id')->get();
        $inbox=message::
        where('reciever_username','=',Auth::user()
        ->username)->where('body','LIKE',"%$val%")->latest('id')->get();
        return response()->json(['outbox'=>$outbox,'inbox'=>$inbox]);
        
    }
}
