<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        foreach($posts as $post){
            $data=Like::where('uid',$request->uid)->where('post_id',$post->id)->exists();
            if ($data) {
                $post->isLike ='true';
            } else {
                $post->isLike = 'false';
            }
            $like_count = Like::where('post_id',$post->id)->count();
            $post->likeCount = $like_count;
        }

        return response()->json([
            'data' => $posts
        ],200);
    }

    public function post(Request $request)
    {
        $users = User::where('uid', $request->uid)->get();
        foreach($users as $user){
            $user_name = $user['name'];
        }
        $post = new Post;
        $post->content = $request->content;
        $post->uid = $request->uid;
        $post->user_name=$user_name;
        $post->save();
        return response()->json([
            'data' => $post
        ],201);
    }

    public function delete(Request $request)
    {
        $data = Post::where('uid',$request->uid)->where('id',$request->post_id)->delete();
        if($data){
            $result = '削除しました。';
        }
        return response()->json([
            'data' => $result
        ],201);
    }
}
