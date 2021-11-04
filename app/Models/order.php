<?php

namespace App\Models;
use App\Models\User;
use App\Models\RegisterProduct;
use App\Models\trademark;
use App\Models\replaceCert;
use App\Models\businessName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
protected $fillable=[
'user_id'
,'fullname'
,'email'
,'phone'
,'company_name'
,'company_address'
,'product_names'
,'type'
,'mode'
,'nafdac_status'
,'status'
,'payment'
,'ref_id'
,'business_name_id'
,'trademark_id'
,'replace_cert_id'
,'register_product_id'
     ];
 
    
public function user(){
    return $this->belongsTo(User::class);
  }
public function registerProduct(){
    return $this->belongsTo(RegisterProduct::class);
  }
public function trademark(){
    return $this->belongsTo(trademark::class);
  }
public function businessName(){
    return $this->belongsTo(businessName::class);
  }
public function replaceCert(){
    return $this->belongsTo(replaceCert::class);
  }
}
