<?php
  
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('profile.profile');
    }
    public function indexC()
    {
        return view('profile.profileC');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image',
        ]);
  
        $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatars'), $avatarName);
  
        Auth()->user()->update(['avatar'=>$avatarName]);
        return redirect('/post')->with('info', 'Your profile updated successfully');
    }
      
    public function storeC(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure image file validation
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($user->avatar) {
                $oldAvatarPath = public_path('avatars/' . $user->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }

            // Save new avatar
            $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $user->avatar = $avatarName;
        }

        $user->save();

        return redirect('/post')->with('success', 'Your profile updated successfully');
    }



    public function follow(Request $request, $id)
    {
        $userToFollow = User::find($id);

        if ($userToFollow) {
            $userToFollow->followers()->attach(Auth::id());
        }

        return back();
    }

    public function unfollow(Request $request, $id)
    {
        $userToUnfollow = User::find($id);

        if ($userToUnfollow) {
            $userToUnfollow->followers()->detach(Auth::id());
        }

        return back();
    }

    // In your ProfileController or equivalent controller
public function showProfile($userId)
{
    $user = User::findOrFail($userId);

    // Assuming you have an authenticated user
    $isFollowing = Auth::check() ? Auth::user()->isFollowing($user->id) : false;

    return view('profile.profileU', [
        'user' => $user,
        'isFollowing' => $isFollowing
    ]);
}
public function banUser($userId)
{
    
    $user = User::find($userId);

    if ($user) {
        
        if ($user->is_admin) {
            
            if (request()->ajax()) {
                return response('Cannot ban an admin user', 403);
            }

            return Redirect::back()->with('error', 'Cannot ban an admin user');
        }

    
        $user->banned = true;
        $user->save();

        if (request()->ajax()) {
            return response('User banned successfully', 200);
        }

        return Redirect::back()->with('success', 'User banned successfully');
    }
    if (request()->ajax()) {
        return response('User not found', 404);
    }

    return Redirect::back()->with('error', 'User not found');
}


public function unbanUser($userId)
{
    $user = User::find($userId);

    if ($user) {
        $user->banned = false;
        $user->save();

        if (request()->ajax()) {
            return response('User unbanned successfully', 200);
        }

        return Redirect::back()->with('success', 'User unbanned successfully');
    }

    if (request()->ajax()) {
        return response('User not found', 404);
    }

    return Redirect::back()->with('error', 'User not found');
}

public function promoteToAdmin($userId)
    {
        $user = User::findOrFail($userId);

        if (auth()->id() !== 3) {
            if (request()->ajax()) {
                return response('Unauthorized', 403);
            }

            return Redirect::back()->with('error', 'Unauthorized');
        }

        // Promote the user to admin
        $user->is_admin = true;
        $user->save();

        if (request()->ajax()) {
            return response('User promoted to admin successfully', 200);
        }

        return Redirect::back()->with('success', 'User promoted to admin successfully');
    }
public function demoteFromAdmin($userId)
{
    // Check if the authenticated user is the user with ID 3
    if (auth()->id() !== 3) {
        if (request()->ajax()) {
            return response('Unauthorized', 403);
        }

        return Redirect::back()->with('error', 'Unauthorized');
    }

    $user = User::findOrFail($userId);

    // Demote the user from admin status
    $user->is_admin = false;
    $user->save();

    if (request()->ajax()) {
        return response('User demoted from admin successfully', 200);
    }

    return Redirect::back()->with('success', 'User demoted from admin successfully');
}
public function blockUser($userId)
{
    $userToBlock = User::find($userId);

    if (!$userToBlock) {
        return redirect()->back()->with('error', 'User not found.');
    }

    if (auth()->user()->isBlocked($userId)) {
        return redirect()->back()->with('info', 'User is already blocked.');
    }

    Block::create([
        'user_id' => auth()->id(),
        'blocked_user_id' => $userId,
    ]);

    return redirect()->back()->with('success', 'User blocked.');
}

public function unblockUser($userId)
{
    $block = Block::where('user_id', auth()->id())
        ->where('blocked_user_id', $userId)
        ->first();

    if (!$block) {
        return redirect()->back()->with('error', 'Block record not found.');
    }

    $block->delete();

    return redirect()->back()->with('success', 'User unblocked.');
}
public function blockedUsers()
{
    $user = Auth::user();
    $blockedUsers = User::whereIn('id', function ($query) use ($user) {
        $query->select('blocked_user_id')
              ->from('blocks')
              ->where('user_id', $user->id);
    })->get();

    return view('blocked_users', compact('blockedUsers'));
}


}
