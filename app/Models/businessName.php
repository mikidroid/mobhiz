<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\order;
use App\Models\User;
class businessName extends Model
{
    use HasFactory;
protected $fillable=[
'user_id','fullname'
,'email'
,'phone'
,'company_name'
,'company_address'
,'documents'
,'payment'
     ];
  
public function user(){
    return $this->belongsTo(User::class);
  }
public function order(){
    return $this->hasOne(order::class);
  }
}
