<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category','description','status'];

    public function subcategory(){
        return $this->hasMany('App\Subcategory');

    }

}
