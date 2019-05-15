<?php

namespace App\Http\Controllers\Guest;
use Validator;
use App\Models\Comment;
use App\User;
use Auth;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function postComment(Request $request){
        $check=[
            'content'=>'max:100',
        ];
        $mess=[
            'content.max'=>'Bình luận của bạn vượt quá quy định',
        ];
        $validator = Validator::make($request->all(), $check, $mess);
        if($validator->fails()){
            return redirect()->back()->withError($validator)->withInput();
        }else{
            $comment = new Comment;
            $comment->user_id = Auth::user()->id;
            $comment->product_id=$request->product_id;
            $comment->content=$request->content;
            $comment->status=1;
            $comment->save();
            Carbon::setLocale('vi');
           
        return redirect()->back()->with('success', 'Bình luận thành công');
        }
    }
    public function editComment($id, Request $request) {
        $comment = Comment::findOrFail($id);
        if($request->content){           
        $comment->content = $request->content;
        $comment->save();
        return back();
        } else{
            // return back()->with('success', 'Bình luận khong de trong');
            return back();
        }
    }
    public function delComment($id){
        $comment=Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back();
    }
}
