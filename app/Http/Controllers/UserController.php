<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data= $request->all();
        User::create($data);
        return response()->json([
            'data' => $data
        ], 200);
    }
}
