<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PostController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'readmore']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $following = $request->routeIs('post.following');
        $search = $request->input('search');

        // Blocked user IDs များကို တစ်ခါတည်း Array အဖြစ် ယူရန်
        $blockedUserIds = $user ? $user->blockedUsers()->pluck('blocked_user_id')->toArray() : [];

        $query = Post::with(['media', 'user', 'category'])
                     ->whereNotIn('user_id', $blockedUserIds);

        if ($following && $user) {
            $followingIds = $user->following()->pluck('users.id');
            if ($followingIds->isNotEmpty()) {
                $query->whereIn('user_id', $followingIds);
            } else {
                $query->whereRaw('1 = 0'); // Follow လုပ်ထားသူ မရှိပါက ဘာမှ မပြရန်
            }
        }

        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }

        $data = $query->orderBy('id', 'DESC')->paginate(8);

        return view('post.index', ['post' => $data]);
    }

    public function readmore($id)
    {
        // View ဘက်မှာ Media နဲ့ User တွေပါ တစ်ခါတည်း ဝင်လာစေရန် with သုံးပေးခြင်း
        $data = Post::with(['media', 'user', 'category'])->findOrFail($id);
        return view('post.readmore', ['post' => $data]);
    }

    public function add()
    {
        $data = [
            ["id" => 1, "name" => "Happy"],
            ["id" => 2, "name" => "Sad"],
            ["id" => 3, "name" => "Angry"],
            ["id" => 4, "name" => "Love"],
            ["id" => 5, "name" => "Beautiful"],
        ];
        return view('post.add', ['categories' => $data]);
    }

    public function createAndUpload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'media_files.*' => 'mimes:jpg,jpeg,png,gif,mp4,avi|max:2048000',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->back()->with('error', 'User is not authenticated.');
        }
        
        $post = Post::create([
            'user_id' => $userId,
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->hasFile('media_files')) {
            $mediaBatch = [];
            $now = now();

            foreach ($request->file('media_files') as $file) {
                $fileType = $file->getClientMimeType();
                $isVideo = strpos($fileType, 'video') !== false;

                $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
                    'folder' => 'media',
                    'resource_type' => $isVideo ? 'video' : 'image'
                ])->getSecurePath();

                $mediaBatch[] = [
                    'file_path' => $uploadedFileUrl, 
                    'file_type' => $isVideo ? 'video' : 'photo',
                    'post_id' => $post->id,
                    'user_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($mediaBatch)) {
                Media::insert($mediaBatch);
            }
        }
    
        return redirect('/post');
    }
    
    public function delete($id)
    { 
        $post = Post::findOrFail($id);
        if (Gate::allows('post-delete', $post)) {
            $post->delete();
            return redirect('/post')->with('info', 'Your post deleted');
        } else {
            return back()->with('error', 'Unauthorized');
        }
    } 

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (Gate::allows('post-delete', $post)) {
            $categories = [
                ["id" => 1, "name" => "News"],
                ["id" => 2, "name" => "Tech"],
            ];

            return view('post.edit', ['post' => $post, 'categories' => $categories]);
        } else {
            return back()->with('error', 'Unauthorized');
        }
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'media_files.*' => 'mimes:jpg,jpeg,png,gif,mp4,avi|max:2048000',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->hasFile('media_files')) {
            $mediaBatch = [];
            $now = now();
            $userId = Auth::id();

            foreach ($request->file('media_files') as $file) {
                $fileType = $file->getClientMimeType();
                $isVideo = strpos($fileType, 'video') !== false;

                $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
                    'folder' => 'media',
                    'resource_type' => $isVideo ? 'video' : 'image'
                ])->getSecurePath();

                $mediaBatch[] = [
                    'file_path' => $uploadedFileUrl, 
                    'file_type' => $isVideo ? 'video' : 'photo',
                    'post_id' => $post->id,
                    'user_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($mediaBatch)) {
                Media::insert($mediaBatch);
            }
        }

        return redirect('/post')->with('info', 'Post updated successfully');
    }

    public function profile($id)
    {
        // N+1 မဖြစ်စေရန် user ၏ posts များနှင့်အတူ media များကိုပါ တစ်ခါတည်း load လုပ်ခြင်း
        $user = User::withCount('posts')
                    ->with(['posts.media', 'posts.category', 'posts.user'])
                    ->find($id);

        if (!$user) {
            abort(404, 'User not found');
        }

        $isFollowing = Auth::check() ? Auth::user()->isFollowing($user) : false;

        $followerCount = \DB::table('follows')
                            ->where('followed_id', $user->id)
                            ->count();

        return view('profile.profileU', [
            'user' => $user,
            'isFollowing' => $isFollowing,
            'followerCount' => $followerCount,
        ]);
    }

    public function view(Request $request)
    {
        $query = Post::with(['media', 'user', 'category'])->orderBy('id', 'DESC');
        if ($search = $request->input('search')) {
            $query->where('title', 'like', '%' . $search . '%');
        }
        $data = $query->paginate(10);
        return view('admin.view', ['post' => $data]);
    }

    public function deleteAdmin($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/admin/view')->with('info', 'Your post deleted');
    }
 
    public function showUser(Request $request)
    {
        $query = User::withCount(['posts', 'followers']);

        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $users = $query->paginate(10)->appends($request->query());

        return view('admin.user', ['users' => $users]);
    }
}