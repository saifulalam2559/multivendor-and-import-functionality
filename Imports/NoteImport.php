<?php

namespace App\Imports;

use App\Models\Note;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;


class NoteImport implements ToModel,WithHeadingRow,SkipsOnError
{

    
    public function model(array $row)
    {
        
       
      
       $username = trim($row['user_id']);
        
        $user = User::where('name', $username)->first();
        
       if ($user) { 
        
        return new Note([
            
                        "user_id" => $user->id,
                        "kunden_id" => 19,
                        "note_title" => $row['note_title'],
                        "note_description" => $row['note_description']
                      
            
        ]);
        
      } else {
            
            return null;
        }  
        
        
        
    }
    
    
    
    
    
    
   public function onError(Throwable $e)
        {
            // Handle the exception how you'd like.
        }
    

         
   }
        