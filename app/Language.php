<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table="languages";
    public $timestamps=true;
    protected $fillable = [
        'name', 'abbreviation','locale','direction','active'
    ];
    //WE MUST USE scope to apply this function to the model data
    public function scopeActive($query){
        return $query->where('active',1);
    }
    public function scopeSelection($query){
        return $query->select(['id','name','abbreviation','direction','active']);

    }
   // public function getActiveAttribute($val){
    //      return  $val == 1?'مفعل':'غير مفعل';
    //    }
}
