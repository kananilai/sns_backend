<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $uid = $request->user_id;
        $post_id = $request->post_id;
        $data = Like::where('uid',$uid)->where('post_id',$post_id)->exists();
        if($data){
            Like::where('uid',$uid)->where('post_id',$post_id)->delete();
        }else{
            $like = new Like;
            $like->uid = $request->user_id;
            $like->post_id = $request->post_id;
            $like->save();
            return response()->json([
                'data' => $like
            ],201);
        }
    }
}
