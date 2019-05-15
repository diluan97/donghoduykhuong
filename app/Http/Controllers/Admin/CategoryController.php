<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id','desc')->paginate(10);
        return view('admin.category.index')->with(['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');   
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
                'description'=>'required',
            ],
            [
                'name.required'=>'Không được để trống tên danh mục',
                'description.required'=>'Không được để trống phân mô tả',
            ]
            );
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
       }else{
           $category= new Category();
           $category->name=$request->name;
           $category->slug=str_slug($request->name) . rand(100000, 999999);
           $category->description=$request->description;
           $category->parent_id=0;
           $category->status = $request->status;
           if($request->hasFile('image')){
            $file=$request->image;
            $new_image_name=time().$file->getClientOriginalName();
            $category->image=$new_image_name;
            $file->move('image/category',$new_image_name);
           }
           $category->save();
        // if($request->hienthi){
        //     $category->status = 1;
        //     $category->save();
        // }else{
        //     $category->status = 0;
        //     $category->save();
        // }
           return redirect()->route('admin_category.index')->with(['mess'=>'Đã lưu']); 
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
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
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
        $category = Category::findOrFail($id);
        $validator=
        Validator::make(
            $request->all(),
            [
                'name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'Không được để trống tên danh mục',
                'description.required'=>'Không được để trống phân mô tả',
            ]
            );
       if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput();
       }else{
           $category->name=$request->name;
           $category->slug=str_slug($request->name) . rand(100000, 999999);
           $category->description=$request->description;
           $category->status = $request->status;
           $category->parent_id=0;
           if($request->hasFile('image')){
               $file=$request->image;
               $new_image_name=time().$file->getClientOriginalName();
               $category->image=$new_image_name;
               $file->move('image/category',$new_image_name);
           }
           $category->save();
        //    if($request->chuahienthi){
        //        $category->status = 0;
        //        $category->save();
        //    }else{
        //        $category->status = 1;
        //        $category->save();
        //    }
           return redirect()->route('admin_category.index')->with(['mess'=>'Cập nhật thành công']); 
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
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
}
