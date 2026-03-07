<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    
    $query = User::where('id', '!=', Auth::id())
                 ->whereNotIn('id', function ($query) {
                     $query->select('blocked_user_id')
                           ->from('blocks')
                           ->where('user_id', Auth::id());
                 });

    
    if ($search) {
        $query->where('name', 'LIKE', '%' . $search . '%');
    }

    $users = $query->get();
    
    return view('chatindex', compact('users'));
}

    
    public function activeUsers(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
    
        $conversationUserIds = \DB::table('messages')
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
            })
            ->distinct()
            ->pluck('sender_id')
            ->merge(
                \DB::table('messages')
                    ->where(function ($query) use ($user) {
                        $query->where('sender_id', $user->id)
                              ->orWhere('receiver_id', $user->id);
                    })
                    ->distinct()
                    ->pluck('receiver_id')
            )
            ->unique()
            ->toArray();
        $blockedUserIds = $user->blockedUsers()->pluck('blocked_user_id')->toArray();
    
        $query = User::whereIn('id', $conversationUserIds)
                     ->where('id', '!=', $user->id)
                     ->whereNotIn('id', $blockedUserIds);
    
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }
    
        $users = $query->get();
    
        return view('chat_users', compact('users'));
    }
    
    
    public function showMessages($receiverId)
    {
        
        $messages = Message::where(function($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $receiverId);
        })->orWhere(function($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', Auth::id());
        })->get();

        $receiver = User::find($receiverId);

        return view('chatmessage', compact('messages', 'receiver'));
    }
    public function sentMessage(Request $request)
{
    $validated = $request->validate([
        'message' => 'required|string',
        'receiver_id' => 'required|exists:users,id',
    ]);

    $message = Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $validated['receiver_id'],
        'message' => $validated['message'],
    ]);

    

    return redirect()->back()->with('success', 'Message sent!');
}
public function getUnreadCountsBySender()
{
    $userId = Auth::id();

    $unreadCounts = Message::where('receiver_id', $userId)
                           ->whereNull('read_at')
                           ->select('sender_id', \DB::raw('count(*) as count'))
                           ->groupBy('sender_id')
                           ->pluck('count', 'sender_id')
                           ->toArray();

    return response()->json($unreadCounts);
}

    public function markMessagesAsRead($receiverId)
    {
        $updated = Message::where('receiver_id', Auth::id())
                           ->where('sender_id', $receiverId)
                           ->whereNull('read_at')
                           ->update(['read_at' => now()]);
    
        return response()->json(['success' => $updated > 0]);
    }
    
public function getTotalUnreadCount()
{
    $userId = Auth::id();

    $totalUnreadCount = Message::where('receiver_id', $userId)
                               ->whereNull('read_at')
                               ->count();

    return response()->json(['count' => $totalUnreadCount]);
}

}
