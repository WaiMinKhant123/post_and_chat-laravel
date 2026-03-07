<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FriendController extends Controller
{
    public function index()
    {
        $currentUserId = auth()->id();

        // Find mutual friends
        $mutualFriendsIds = DB::table('follows as f1')
            ->join('follows as f2', 'f1.follower_id', '=', 'f2.followed_id')
            ->where('f1.followed_id', $currentUserId)
            ->where('f2.follower_id', $currentUserId)
            ->pluck('f1.follower_id');

        // Retrieve mutual friends
        $friends = User::whereIn('id', $mutualFriendsIds)->get();

        return view('friends.index', compact('friends'));
    }
}
