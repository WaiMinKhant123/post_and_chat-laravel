<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Message;

class CommentController extends Controller
{
    public function create()
 {
 $comment = new Comment;
 $comment->content = request()->content;
 $comment->post_id = request()->post_id;
 $comment->user_id = Auth::id(); 
 $comment->save();
 return back();
 }
public function delete($id)
 {
 $comment = Comment::find($id);
 if( Gate::allows('comment-delete', $comment) ) {
    $comment->delete();
    return back();
    } else {
    return back()->with('error', 'Unauthorize');
    }
 }
 public function deletechat($id)
 {
 $message = Message::find($id);
 if( Gate::allows('chat-delete', $message) ) {
    $message->delete();
    return back();
 } else {
   return back()->with('error', 'Unauthorize');
   }
}
 public function __construct()
{
 $this->middleware('auth');
}
}
