<?php

namespace App\Http\Controllers\Guest;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::whereStatus(1)->paginate(9);
        $categories=Category::whereStatus(1)->get();
        // Trang Slide
        $slides = Slide::whereStatus(1)->get();
        return  view('Guest.home.home')->with([
            'products'=>$products,
            'slides' => $slides,
            'categories'=>$categories,
            ]);  
    }
    public function loginUser(){
        return view('Guest.home.login_user');
    }
    public function editUser($id, Request $request){
        $user= User::finfOrFail($id);
        $user->name= $request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->save();
        return back();
    } 
    public function policy(){
        return view('guest.policy.policy');
    }
    
}
