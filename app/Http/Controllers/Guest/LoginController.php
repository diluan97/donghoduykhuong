<?php

namespace App\Http\Controllers\Guest;
use App\User;
use Validator;
use Hash;
use Cart;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function getLogin(Request $request){
        $rules=[
            'email'=>'required|email',
            'password'=>'required|min:7',
        ];
        $message=[
            'email.required'=>'Không để trống email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Bắt buộc nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất có 7 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return redirect()->back()->withError($validator)->withInput();
        }else{
            $email = $request->input('email');
            $pass = $request->input('password');
            if(Auth::attempt(['email'=>$email, 'password'=>$pass])){
                return redirect()->route('home');
            }
        }
    }

    public function getRegister(Request $request){
        $this->validate(
            $request,
            [
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'email.required' => 'Email là trường bắt buộc',
                'email.unique' => 'Email đã có người sử dụng',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Mật khẩu là trường bắt buộc',
                'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
                'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu ',
                'password_confirmation.same' => "Nhập lại mật khẩu không chính xác",
            ]
        );

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->role = 0;
        $user->save();

        return redirect()->back()->with('success', 'Đăng kí thành công');
    }
    public function postUser($id , Request $request){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return back()->with('success','Lưu Thành Công');
    }
}
