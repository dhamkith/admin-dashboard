<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('auth:admin', ['except' => [ 'store']]);
    }

    /**
     * Display a listing of the comments admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function commentsall()
    {
        $comments = Comment::orderBy('created_at', 'DESC')
                    ->paginate(30);
        
        if(auth('admin')->check()) {  
            return view('admin.comments.comments-all', compact('comments'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
}
