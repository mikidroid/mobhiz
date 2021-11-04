<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
protected $fillable=[
'user_id'
,'image'
,'title'
,'details'
,'client'
,'duration'
     ];
  
public function user(){
    return $this->belongsTo(User::class);
  }
}
