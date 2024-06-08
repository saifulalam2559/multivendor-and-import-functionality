<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Kunden;



class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    protected $fillable = [
        'name',
        'username',
        'photo',
        'phone',
        'role',
        'status',
        'current_team_id',
        'profile_photo_path',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $appends = [
        'profile_photo_url',
    ];
    
    
    public function yesAdmin() {

          return $this->role == 'admin' ;
          
        }
        
        
      public function yesSeller() {

          return $this->role == 'seller' ;
          
        }
        
        
        
        public function yesFreelancer() {

          return $this->role == 'freelancer' ;
          
        }
        
        
        
       
        
        
}