<?php

namespace App\Http\Controllers\Admin;
use Validator;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::paginate(10);
        return view('admin.slider.index')->with(['slide'=>$slide]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');   
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

            ],
            [
                'name.required'=>'Không được để trống tên sản phẩm',
            ]
            );
        if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput();
        }else{
           $slide= new Slide();
           $slide->name=$request->name;
           $slide->status = $request->status;
           if($request->hasFile('image')){
               $file=$request->image;
               $new_image_name=time().$file->getClientOriginalName();
               $slide->image=$new_image_name;
               $file->move('image/slide',$new_image_name);
           }
           $slide->save();
        //    if($request->chuahienthi){
        //        $slide->status=0;
        //        $slide->save();
        //    }else{
        //        $slide->status=1;
        //        $slide->save();
        //    }
           return redirect()->route('admin_slide.index')->with([
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
        $slide=Slide::find($id);
        return view('admin.slider.edit',compact('slide'));
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
        $slide = Slide::findOrFail($id);
        $validator=
        Validator::make(
            $request->all(),
            [
                'name'=>'required',

            ],
            [
                'name.required'=>'Không được để trống tên sản phẩm',

            ]
            );
       if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput();
       }else{
           $slide->name=$request->name;
           $slide->status = $request->status;
           if($request->hasFile('image')){
               $file=$request->image;
               $new_image_name=time().$file->getClientOriginalName();
               $product->image=$new_image_name;
               $file->move('image/slide',$new_image_name);
           }
           $slide->save();
        //    if($request->chuahienthi){
        //        $slidet->status=0;
        //        $slide->save();
        //    }else{
        //        $slide->status=1;
        //        $slide->save();
        //    }
           return redirect()->route('admin_slide.index')->with(['mess'=>'Cập nhật thành công']); 
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
        $item=Slide::findOrFail($id);
        $item->delete();
        return back();
    }
}
