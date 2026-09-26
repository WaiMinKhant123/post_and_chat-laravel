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
      $blockedUserIds = $user->blockedUsers()->pluck('blocked_user_id')->toArray();
      if ($following) {
          $followingIds = $user->following->pluck('id');
          if ($followingIds->isNotEmpty()) {
              $data = Post::whereIn('user_id', $followingIds)
                          ->whereNotIn('user_id', $blockedUserIds);
          } else {
              $data = collect();
          }
      } else {
          $data = Post::whereNotIn('user_id', $blockedUserIds);
      }
      if ($search) {
          $data->where('title', 'LIKE', '%' . $search . '%');
      }
  
      $data = $data->with(['media', 'user', 'category'])->orderBy('id', 'DESC')->paginate(8);
      return view('post.index', ['post' => $data]);
  }

    public function readmore($id)
    {
        $data = Post::find($id);
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
            'media_files.*' => 'mimes:jpg,jpeg,png,gif,mp4,avi|max:2048000', // Validation for files
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->back()->with('error', 'User is not authenticated.');
        }
        
        $post = Post::create([
            'user_id' => $userId, // Auth user_id ကို သုံးရန်
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $fileType = $file->getClientMimeType();
                $isVideo = strpos($fileType, 'video') !== false;

               $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
    'folder' => 'media',
    'resource_type' => $isVideo ? 'video' : 'image'
])->getSecurePath();
                Media::create([
                    'file_path' => $uploadedFileUrl, 
                    'file_type' => $isVideo ? 'video' : 'photo',
                    'post_id' => $post->id,
                    'user_id' => $userId,
                ]);
            }
        }
    
        return redirect('/post');
    }
    
    public function delete($id)
    { 
        $post = Post::find($id);
        if( Gate::allows('post-delete', $post) ) {
            $post->delete();
            return redirect('/post')->with('info', 'Your post deleted');
        } else {
            return back()->with('error', 'Unauthorize');
        }
    } 

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if( Gate::allows('post-delete', $post) ) {
            $categories = [
                ["id" => 1, "name" => "News"],
                ["id" => 2, "name" => "Tech"],
            ];

            return view('post.edit', ['post' => $post, 'categories' => $categories]);
        } else {
            return back()->with('error', 'Unauthorize');
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

        // Update လုပ်တဲ့နေရာမှာလည်း Cloudinary သို့ တင်ရန် ပြင်ဆင်ထားသည်
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $fileType = $file->getClientMimeType();
                $isVideo = strpos($fileType, 'video') !== false;

             $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
    'folder' => 'media',
    'resource_type' => $isVideo ? 'video' : 'image'
])->getSecurePath();

                Media::create([
                    'file_path' => $uploadedFileUrl, 
                    'file_type' => $isVideo ? 'video' : 'photo',
                    'post_id' => $post->id,
                    'user_id' => Auth::id(),
                ]);
            }
        }

        return redirect('/post')->with('info', 'Post updated successfully');
    }

    public function profile($id)
    {
        $user = User::withCount('posts')->with('posts')->find($id);

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
        $query = Post::with('media')->orderBy('id', 'DESC');
        if ($search = $request->input('search')) {
            $query->where('title', 'like', '%' . $search . '%');
        }
        $data = $query->paginate(10);
        return view('admin.view', ['post' => $data]);
    }

    public function deleteAdmin($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/admin/view')->with('info', 'Your post deleted');
    }
  
   public function showUser(Request $request)
{
    // posts နဲ့ followers အရေအတွက်ကို withCount နဲ့ တစ်ခါတည်း ဆွဲထုတ်ပါ
    $query = User::withCount(['posts', 'followers']);

    // Search query ရှိမရှိ စစ်ဆေးခြင်း
    if ($search = $request->input('search')) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    // Pagination (တစ်မျက်နှာကို ၁၀ ယောက်ပြမည်) พร้อมกับ search query ဆက်ပါသွားစေရန် appends သုံးနိုင်သည်
    $users = $query->paginate(10)->appends($request->query());

    // Loop ပတ်ပြီး query ထပ်ခေါ်စရာ မလိုတော့ပါ (N+1 Problem ရှင်းပြီး)

    return view('admin.user', ['users' => $users]);
} }