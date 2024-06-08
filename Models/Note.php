<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kunden;


class Note extends Model
{
    use HasFactory;
    
            protected $fillable = [
            
            'note_title',
            'note_description',
            'kunden_id',
            'user_id',


    ];
            
            
            public function kunden() {

            return $this->belongsTo(Kunden::class,'kunden_id','id');

        }
        
        
         public function user() {

            return $this->belongsTo(User::class);

        }
            
            
            
}
