<?php

namespace App\Imports;

use App\Models\Kunden;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;




class KundenImport implements ToModel,WithHeadingRow,SkipsOnError
{
 
    
    public function model(array $row)
    {
        
        
        if (isset($row['unternehmen'] , $row['kunde_email'] , $row['telefonnr'] , $row['bundesland'] , $row['branche'], $row['branche_link'], $row['kunde_domain'],$row['plz'], $row['ort'])) {


                        $slug = Str::slug($row['unternehmen']);
                        $slug_count = Kunden::where('slug',$slug)->count();

                        if($slug_count>0){

                            $slug = time().'-'.$slug;

                        }



                         $kundeemail = $row['kunde_email'] ;
                         $text = 'neu.';
                         $fakeemail = str_replace(' ', '', $text.$kundeemail); 
                         
                         

                         $job = '["JOB PORTAL"]';
                        
                         // start random password creation
                         
                            $sets = array();
                            $sets[] = '^&';
                            $sets[] = '$%';
                            $sets[] = '@#';
                            $sets[]  = '*{';
                            $sets[]  = '?/';
                            $sets[]  = ':_';
                            $sets[]  = '!$';
                            $sets[]  = '*&';
                            $sets[]  = '?&';
                            $sets[]  = '*/';
                            $sets[]  = '&@';

                            $randomSet = $sets[array_rand($sets)]; 

                            $randompassword = Str::random(3).$randomSet.Str::random(5);
                            
                           


                    $kunden =  new Kunden([

                         "firmenname" => $row['unternehmen'],        
                         "slug" => $slug,
                         "fake_email" => $fakeemail,
                        "ansprechpartner_email" => trim($row['kunde_email']),   
                         "inhaber_tel" => $row['telefonnr'],
                         "user_id" => 54,
                         "bundesland" => $row['bundesland'],
                        "category_name" => $row['branche'],
                        "category_link" => $row['branche_link'],
                        "domain" => $row['kunde_domain'],
                        "interesse" => $job,
                        "plz" => $row['plz'],
                        "ort" => $row['ort'],
                        "password" => $randompassword,
                        "account_created" => 'inactive',

                     ]);

                     return $kunden ;




                     }else {



                     }

            
        
    }
    

    
        public function onError(Throwable $e)
        {
            // Handle the exception how you'd like.
        }
    

         
   }
        
        
       
    
    

