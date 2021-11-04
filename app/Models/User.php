<?php

namespace App\Models;
use App\Models\RegisterProduct;
use App\Models\message;
use App\Models\reply;
use App\Models\order;
use App\Models\replaceCert;
use App\Models\project;
use App\Models\businessName;
use App\Models\trademark;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'profile_pic'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
public function order(){
    return $this->hasMany(order::class);
  }
public function registerProduct(){
    return $this->hasMany(RegisterProduct::class);
  }
public function message(){
    return $this->hasMany(message::class);
  }
public function reply(){
    return $this->hasMany(reply::class);
  }
public function businessName(){
    return $this->hasMany(businessName::class);
  }
public function trademark(){
    return $this->hasMany(trademark::class);
  }
public function replaceCert(){
    return $this->hasMany(replaceCert::class);
  }
public function project(){
    return $this->hasMany(project::class);
  }
}
