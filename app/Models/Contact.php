<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable=[
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
    public function status(){
        if($this->status == 1){
            echo"Đã dọc";
        }else{
            echo"Chưa đọc";
        }
    }
}
