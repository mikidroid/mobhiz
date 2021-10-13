<?php

namespace App\Models;
use App\Models\User;
use App\Models\message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  use HasFactory;
  protected $fillable=[
            'user_id',
            'message_id',
            'reciever_username',
            'username',
            'subject',
            'content',
            'file' ];
            
public function user(){
      return $this->belongsTo(User::class);
     }
public function message(){
      return $this->belongsTo(message::class);
     }
}
