<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $query = Post::with('media')->orderBy('id', 'DESC');
    
        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }
    
        return response()->json($query->get());
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'media_files.*' => 'mimes:jpg,jpeg,png,gif,mp4,avi|max:2048000',
        ]);
    
        $userId = $request->user()->id;
    
        $post = Post::create([
            'user_id' => $userId,
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);
    
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $filePath = $file->store('photos', 'public');
                $fileType = $file->getClientMimeType();
    
                Media::create([
                    'file_path' => $filePath,
                    'file_type' => strpos($fileType, 'video') !== false ? 'video' : 'photo',
                    'post_id' => $post->id,
                    'user_id' => $userId,
                ]);
            }
        }
    
        return response()->json(['message' => 'Post created', 'post' => $post], 201);
    }
    

   // GET /api/posts/{id}
public function show($id)
{
    return Post::with('media')->findOrFail($id);
}

// PUT /api/posts/{id}
public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    if ($request->user()->cannot('update', $post)) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $post->update($request->only('title', 'body', 'category_id'));

    return response()->json(['message' => 'Post updated', 'post' => $post]);
}

// DELETE /api/posts/{id}
public function destroy($id)
{
    $post = Post::findOrFail($id);

    if (request()->user()->cannot('delete', $post)) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $post->delete();

    return response()->json(['message' => 'Post deleted']);
}
}