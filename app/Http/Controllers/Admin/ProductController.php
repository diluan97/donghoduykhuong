<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate(5);
        return view('admin.product.index')->with(['product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create')->with([
            'categories' => $categories,
        ]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator=
        Validator::make(
            $request->all(),
            [
                'name'=>'required',
                'short_description'=>'required',
                'quantity'=>'required|numeric',
                'price'=>'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',

            ],
            [
                'name.required'=>'Không được để trống tên sản phẩm',
                'short_description.required'=>'Không được để trống phần thông tin sản phẩm',
                'quantity.required'=>'Không được để trống số lượng sản phẩm',
                'price.required'=>'Không để trống giá sản phẩm',
            ]
            );
        if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput();
        }else{
           $product= new Product();
           $product->name=$request->name;
           $product->slug=str_slug($request->name) . rand(100000, 999999);
           $product->short_description=$request->short_description;
           $product->status = $request->status;
           if($request->hasFile('image')){
               $file=$request->image;
               $new_image_name=time().$file->getClientOriginalName();
               $product->image=$new_image_name;
               $file->move('image/product',$new_image_name);
           }
           $product->quantity=$request->quantity;
           $product->price=$request->price;
           $product->category_id = $request->category_id;
           $product->save();
        //    if($request->chuahienthi){
        //        $product->status=0;
        //        $product->save();
        //    }else{
        //        $product->status=1;
        //        $product->save();
        //    }
           return redirect()->route('admin_product.index')->with([
               'mess'=>'Đã lưu',
               
               ]); 
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validator=
        Validator::make(
            $request->all(),
            [
                'name'=>'required',
                'short_description'=>'required',
                'quantity'=>'required|numeric',
                'price'=>'required|numeric',

            ],
            [
                'name.required'=>'Không được để trống tên sản phẩm',
                'short_description.required'=>'Không được để trống phân thông tin sản phẩm',
                'quantity.required'=>'Không được để trống số lượng sản phẩm',
                'price.required'=>'Không để trống giá sản phẩm',
            ]
            );
       if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput();
       }else{
           $product->name=$request->name;
           $product->slug=str_slug($request->name) . rand(100000, 999999);
           $product->short_description=$request->short_description;
           $product->quantity=$request->quantity;
           $product->price=$request->price;
           $product->status = $request->status;
           if($request->hasFile('image')){
               $file=$request->image;
               $new_image_name=time().$file->getClientOriginalName();
               $product->image=$new_image_name;
               $file->move('image/product',$new_image_name);
           }
           $product->save();
        //    if($request->chuahienthi){
        //        $product->status=0;
        //        $product->save();
        //    }else{
        //        $product->status=1;
        //        $product->save();
        //    }
           return redirect()->route('admin_product.index')->with(['mess'=>'Cập nhật thành công']); 
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Product::findOrFail($id);
        $item->delete();
        return back(); 
    }

    public function searchProduct(Request $request){
        $search=$request->searchproduct;
        if($search){
            $product = Product::where('name','like','%'. $search. '%')->get();
        }
        return view('admin.product.search')->with(['product'=>$product]);
    }
}
