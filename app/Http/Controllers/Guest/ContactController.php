<?php

namespace App\Http\Controllers\Guest;
use App\Models\Contact;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function getContact()
    {
        return view('Guest.contact.contact');

    }
    public function postContract(Request $request)
    {
        $check=[
           'email'=>'required|email',
           'name'=>'required',
           'subject'=>'required|max:200',
           'message'=>'required|max:500',
        ];
        $mess=[
            'email.required'=>'Anh/chị vui lòng nhập email',
            'email.email'=>'Anh/chị vui lòng nhập đúng định dạng email',
            'name.required'=>'Anh/chị vui lòng nhập họ và tên',
            'subject.required'=>'Anh/chị vui lòng nhập chủ đề',
            'subject.max'=>' Xin lỗi tên chủ đề quá dài',
            'message.required'=>'Anh/chị muốn liên hệ hoặc góp ý gì với chúng tôi',
            'message.max'=>'Xin lỗi nội dung quá dài',
        ];
        $validator = Validator::make($request->all() , $check, $mess);
        if($validator->fails()){
            return redirect()->route('contact')->withErrors($validator)->withInput();
        }else{
            $contact = Contact::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=> '0977770404',
                'subject'=>$request->subject,
                'message'=>$request->message,
            ]);
            return redirect()->route('home')->with(['success'=> 'Yêu cầu của bạn đã được gửi']);
        }
    }
}
