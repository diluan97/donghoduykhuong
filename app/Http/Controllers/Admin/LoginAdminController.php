<?php

namespace App\Http\Controllers\Admin;
use Validator;
use Auth;
use App\User;
use Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginAdminController extends Controller
{
    public function getLogin(){
        return view('admin.login.login');
    }

    public function postLogin(Request $request)
    {
        $rules=[
            'email'=>'required|email',
            'password'=>'required|min:7'
        ];
        $message=[
            'email.required'=> 'Không được để trống email',
            'email.email'=> 'Email không đúng địng dạng',
            'password.required' => 'Không để mật khẩu',
            'password.min' => 'Mật khẩu ít nhất phải có 7 ký tự',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
     
        if($validator->fails()){
          
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $email = $request->input('email');
            $password=$request->input('password');

            if(Auth::attempt(['email'=> $email,'password' => $password])){
                if(Auth::user()->role == 1){
                    return redirect()->route('admin_drash');
                }
            }else{
                return redirect()->back()->with('errorlogin',"Email hoặc mật khẩu sai vui lòng nhập lại");
            }
            return redirect()->back()->with('errorlogin',"Bạn không thể truy cập trang này");
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

}
