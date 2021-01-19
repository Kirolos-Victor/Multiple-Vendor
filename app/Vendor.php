<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Vendor extends Model
{
    use Notifiable;
    protected $table="vendors";
    public $timestamps=true;
    protected $fillable = [
        'name', 'mobile','address','email','active','logo_image','password','main_category_id','latitude','longitude'
    ];
    protected $hidden = [
        'main_category_id','password'
    ];

    public function scopeActive($q){
        return $q->where('active',1);
    }
    public function scopeSelection($q){
        return$q->select('id','name','mobile','address','active','logo_image','main_category_id','email');
    }
    public function setPasswordAttribute($password){
        if(!empty($password)){
            $this->attributes['password']=Hash::make($password);
        }
    }
    public function main_category(){
        return $this->belongsTo(MainCategories::class,'main_category_id','id');
    }
}
