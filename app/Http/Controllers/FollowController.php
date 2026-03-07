<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FollowController extends Controller
{
    public function follow($id)
    {
        $user = User::find($id);
        if ($user) {
            Auth::user()->following()->attach($user->id);
        }
        return redirect()->back();
    }

    public function unfollow($id)
    {
        $user = User::find($id);
        if ($user) {
            Auth::user()->following()->detach($user->id);
        }
        return redirect()->back();
    }

    
}


