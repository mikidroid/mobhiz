<?php

namespace App\Models;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
 use HasFactory;
 protected $fillable=[
          'user_id',
          'reciever_username',
          'username',
          'subject',
          'body',
          'read',
          'file' ];
 public function user(){
      return $this->belongsTo(User::class);
     }
public function reply(){
      return $this->hasMany(Reply::class,'message_id');
     }
}
