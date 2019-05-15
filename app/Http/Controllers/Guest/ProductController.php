<?php

namespace App\Http\Controllers\Guest;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function detail_product($id)
    {
        $comment = Comment::with('product','user')->where('product_id',$id)->where('status',1)->orderBy('id','desc')->paginate(5);
        
        $detail= Product::where('id',$id)->first();
        return view('Guest.product.detail_product')->with([
            'detail'=>$detail,
            'comment'=>$comment,
            ]);

    }
}
