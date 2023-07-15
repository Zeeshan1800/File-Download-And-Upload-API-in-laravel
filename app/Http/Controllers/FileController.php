<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //Upload Function in Controller
    public function upload(Request $request)
    {
        $fileName = $request->input('fileName');
        $content =  $request->input('content');
    
        Storage::put($fileName, $content);
        $size = Storage::size($fileName);

        if($size>99){
            Storage::delete($fileName);
            return "INTERNAL_SERVER_ERROR :File is greater than 100kb";
        }
        else{
            //Uploads the file
        Storage::put($fileName, $content);

        return "File uploaded Successfully 201";
        } 
    
        return "I am working fine . $size";
     
    }
    //Download funciton in Controller
    public function download(Request $request)
    {
       $fileName = $request->input('fileName');

        //Find the File
        if(Storage::exists($fileName)) {

            return Storage::download($fileName);
            
        } else {
            return "File not Exists 404.";
        }

        

      
    }

}
