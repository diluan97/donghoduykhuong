<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'name',
        'slug',
        'status',
        'description',
        'parent_id',
        'context_type',
        'image',
    ];
    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id');
    }
    public function status(){
        if($this->status == 1){
            echo"Hoạt động";
        }else{
            echo"Chưa hoạt động";
        }
    }
}
