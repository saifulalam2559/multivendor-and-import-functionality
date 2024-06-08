<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Note;




class Kunden extends Model
{
    use HasFactory;
    
    
        protected $fillable = [
            
            'firmenname',
            'slug',
            'domain',
            'password',
            'ansprechpartner_email',
            'ansprechpartner_name',
            'category_name',
            'category_link',
            'status',
            'start_date',
            'end_date',
            'inhaber',
            'inhaber_tel',
            'ansprechpartner_tel',
            'email_sent',
            'againansprechpartner_email',
            'user_id',
            'kundelust',
            'angerufen_date',
            'anruftermin',
            'small_note',
            'fake_email',
            'lamangoolive_link',
             'interesse',
            'auslandosterreich',
            'auslandschweiz',
            'deutschland',
            'weiterelander',
            'niederlande',
            'luxemburg',
            'frankreich',
            'belgien',
            'danemark',
            'polen',
            'tschechei',
            'bundesland',
            'plz',
            'ort',
            'account_created',
             'freelancer',
            'password_changed',
           


    ];
        
        
         public function user() {

            return $this->belongsTo(User::class,'user_id','id');

        }
        
        
        public function note() {
        
        return $this->hasMany(Note::class,'kunden_id','id');
    }
        
        
        
}
