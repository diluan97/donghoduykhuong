<?php

namespace App\Http\Controllers\Guest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getSearch(Request $request){
        $searchproduct = $request->searchproduct;
      
        if($searchproduct){
            $products = Product::where('name','LIKE',"%{$searchproduct}%")->whereStatus(1)->get();
            return view('guest.search.search')->with([
                'products' =>$products,
                'searchproduct'=>$searchproduct,
            ]);
        }  
        // if(!$searchproduct){
        //     return back();
        // }
        $searchCategory = $request->searchCategory;
        if($searchCategory){
            $cate = Category::where('id',$searchCategory)->first();
            $products = Product::where('category_id' ,$searchCategory)->whereStatus(1)->get();
            return view('guest.search.search')->with([
                'products'=>$products,
                'cate'=>$cate,
                'searchCategory'=>$searchCategory,
                'searchproduct'=>$searchproduct,
            ]);
        }

        $price = $request->searchPrice;
        if($price){
            if($price == 1){
                $products = Product::whereBetween('price',[1000000,5000000])->get();
            }
            if($price == 2){
                $products = Product::whereBetween('price',[5000000,10000000])->get();
            }
            if($price == 3){
                $products = Product::whereBetween('price',[10000000,20000000])->get();
            }
            if($price == 4){
                $products = Product::whereBetween('price',[20000000,40000000])->get();
            }
            
        }
        return view('guest.search.search')->with([
            'products'=>$products,
            'price'=>$price,
            'searchCategory'=>$searchCategory,
            'searchproduct'=>$searchproduct,
        ]);
        
    }
}
