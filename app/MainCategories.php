<?php

namespace App;

use App\Observers\MainCategoriesObserver;
use Illuminate\Database\Eloquent\Model;

class MainCategories extends Model
{
    protected $table="main_categories";
    public $timestamps=true;
    protected $fillable = [
        'name', 'translation_language','translation_of','slug','active','photo','translation_of'
    ];
    public function scopeActive($q){
        return $q->where('active',1);
    }
    public function scopeSelection($q){
        return$q->select('id','name','translation_language','slug','active','photo','translation_of');
    }
    public function scopeMain_categories_select(){
        return $this->where('translation_language',mainLanguage());
    }
    public function categories(){
        return $this->hasMany(self::class,'translation_of');
    }
    public function vendors(){
        return$this->hasMany(Vendor::class,'main_category_id','id');
    }
    protected static function boot()
    {
        Parent::boot();
        MainCategories::observe(MainCategoriesObserver::class);
    }
}
