<?php

namespace App;



use Illuminate\Database\Eloquent\Model;
use App\Category;

class Subcategory extends Model
{
    protected $fillable = ['subcategory','category_id','description','status'];

    public function categories(){

        return $this->belongsTo(Category::class,'category_id');
    }
    public function posts(){
        return $this->hasMany('App\Post');
    }

}
