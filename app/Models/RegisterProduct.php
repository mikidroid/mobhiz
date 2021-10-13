<?php

namespace App\Models;
use App\Models\User;
use App\Models\RegisterProduct;
use App\Models\order;
use App\Models\businessName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterProduct extends Model
{
    use HasFactory;
protected $fillable=[
'user_id','fullname'
,'email'
,'phone'
,'company_name'
,'company_address'
,'company_email'
,'company_phones'
,'product_names'
,'documents'
,'type',
'payment'
     ];
 protected $casts=[
    'company_phones'=>'array'
  ];
 
  public function registrationStatus(){
   
  }
  
public function user(){
    return $this->belongsTo(User::class);
  }
public function order(){
    return $this->hasOne(order::class);
  }
}
