<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'content',
        'user_id',
        'product_id',
        'status',
    ];

    function product(){
        return $this->belongsTo('App\Models\Product');
    }
    function user(){
        return $this->belongsTo('App\User');
    }
    public function status(){
        if($this->status == 1){
            echo"Hoạt động";
        }else{
            echo"Chưa hoạt động";
        }
    }
}
