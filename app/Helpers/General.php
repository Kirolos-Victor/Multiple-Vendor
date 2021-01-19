<?php

use Illuminate\Support\Facades\Config;

function getActiveLanguages(){
 return  \App\Language::active()->selection()->get();
}
function mainLanguage(){
   return Config::get('app.locale');
}
function uploadImage($folder,$image){
    $image->store('/',$folder);
    $filename=$image->hashName();
    $path='assets/images/'.$folder.'/'.$filename;
    return $path;

}
function checkActive($status)
{
    if($status == null)
    {
        return 0;
    }
    else
    {
        return 1;
    }
}
