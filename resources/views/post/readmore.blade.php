@extends("layouts.app")

@section("content")
<div class="container py-4">
    <!-- Post Main Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h3 class="card-title fw-bold text-dark mb-3">{{ $post->title }}</h3>
            
            <div class="card-subtitle mb-3 text-muted small">
                Post by <b><a href="{{ url('/profile/' . ($post->user ? $post->user->id : '#')) }}" class="link-primary text-decoration-none">{{ $post->user ? $post->user->name : 'Unknown User' }}</a></b> • 
                {{ $post->created_at->diffForHumans() }} • 
                Category: <span class="badge bg-secondary">{{ $post->category->name ?? 'General' }}</span>
            </div>

            <p class="card-text text-secondary fs-6" style="white-space: pre-line;">{{ $post->body }}</p>

            @if(Auth::check() && (Auth::id() == $post->user_id || optional(Auth::user())->is_admin))
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <a class="btn btn-outline-primary btn-sm px-3" href="{{ url("/post/edit/$post->id") }}"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a class="btn btn-outline-danger btn-sm px-3" href="{{ url("/post/delete/$post->id") }}" onclick="return confirm('Are you sure you want to delete this post?')"><i class="bi bi-trash"></i> Delete</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Media Gallery Section (Cloudinary Integration) -->
    @if($post->media && $post->media->count() > 0)
        <div class="mb-4">
            <h5 class="fw-bold mb-3">Attached Media</h5>
            <div class="row row-cols-1 row-cols-md-2 g-3">
                @foreach($post->media as $media)
                    <div class="col">
                        <div class="card shadow-sm border-0 overflow-hidden h-100">
                            @if($media->file_type === 'video')
                                <video class="w-100 h-100 object-fit-cover" controls style="max-height: 400px; background: #000;">
                                    <source src="{{ $media->file_path }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ $media->file_path }}" class="w-100 h-100 object-fit-cover" alt="Post Media" style="max-height: 400px;">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Comments Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Comments ({{ $post->comments ? count($post->comments) : 0 }})</h5>
        </div>
        <div class="card-body">
            @if($post->comments && $post->comments->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1 text-dark">{{ $comment->content }}</p>
                                    <div class="text-muted small">
                                        By <b>{{ $comment->user->name ?? 'Anonymous' }}</b> • 
                                        {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                @if(Auth::check() && (Auth::id() == $comment->user_id || Auth::id() == $post->user_id))
                                    <a href="{{ url("/comments/delete/$comment->id") }}"
                                       class="text-danger text-decoration-none" title="Delete Comment">
                                       <i class="bi bi-trash fs-5"></i>
                                    </a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted text-center my-3">No comments yet. Be the first to comment!</p>
            @endif
        </div>
    </div>

    <!-- Add Comment Form -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Leave a Comment</h5>
            <form action="{{ url('/comments/add') }}" method="post">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <textarea name="content" rows="3" class="form-control" placeholder="Write your comment here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary px-4">Add Comment</button>
            </form>
        </div>
    </div>
</div>
@endsection