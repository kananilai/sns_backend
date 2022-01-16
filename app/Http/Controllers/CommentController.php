<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    public function index($id)
    {
        return Post::find($id);
    }

    public function store(Request $request)
    {
        $users= User::where('uid',$request->user_id)->get();
        foreach($users as $user){
            $user_name = $user['name'];
        }
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id=$request->user_id;
        $comment->comment = $request->comment;
        $comment->user_name = $user_name;
        $comment->save();
        return response()->json([
            'data' => $comment
        ],201);
    }

    public function get($id)
    {
        $posttData = Post::where('id',$id)->get();
        return response()->json([
            'data' => $posttData
        ],201);
    }

    public function getComment($id)
    {
        $user=
        $commentData = Comment::where('post_id',$id)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'data' => $commentData
        ],201);
    }
}
