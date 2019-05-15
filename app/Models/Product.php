<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'name',
        'slug',
        'status',
        'short_description',
        'quantity',
        'image',
        'price',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order','product_order');  
    }
    public function productOrders()
    {
        return $this->hasMany('App\Models\ProductOrder');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
    public function status(){
        if($this->status == 1){
            echo"Hoạt động";
        }else{
            echo"Chưa hoạt động";
        }
    }
}

