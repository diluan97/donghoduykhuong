<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'sliders';
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'slug',
        'image',
    ];
    public function status(){
        if($this->status == 1){
            echo"Hoạt động";
        }else{
            echo"Chưa hoạt động";
        }
    }
}
