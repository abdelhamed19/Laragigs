<?php

namespace App\tarits;
use Illuminate\Http\Request;

trait upload
{
    public function upload(Request $request,$foldername)
    {
        $img=$request->file("photo")->getClientOriginalName();
        $path= $request->file("photo")->storeAs($foldername,$img,"storess");
        return $path;
    }
}
