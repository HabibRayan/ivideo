<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','subcategory_id','short_description','long_description','video_link','tag','status'];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
}
