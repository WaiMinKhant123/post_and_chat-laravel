@extends("layouts.app")

@section("content")
<div class="container">
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <div class="card-subtitle mb-2 text-muted small">
               Post by "<b><a href="profile.php" class="link-dark text-decoration-none">{{$post->user ? $post->user->name : 'Unknown User'}}</a></b>",
                {{ $post->created_at->diffForHumans() }},
                Category: <b>{{ $post->category->name }}</b>
            </div>
            <p class="card-text">{{ $post->body }}</p>
            <a class="btn btn-warning" href="{{ url("/post/delete/$post->id") }}">Delete</a>      <a class="btn btn-warning" href="{{ url("/post/edit/$post->id") }}">Edit</a>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4 mx-2">
            @foreach($post->media as $media)
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            @if(strpos($media->file_path, '.mp4') !== false)
                                <video class="card-img-top" controls style="width: 100%; height: 400px;">
                                    <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $media->file_path) }}" class="card-img-top" alt="{{ $media->file_path }}" style="width: 100%; height: 400px;">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <ul class="list-group mb-2">
        <li class="list-group-item active">
            <b>Comments ({{ count($post->comments) }})</b>
        </li>
        @foreach($post->comments as $comment)
            <li class="list-group-item">
                <p>{{ $comment->content }}</p>
                <a href="{{ url("/comments/delete/$comment->id") }}"
                   class="bi bi-trash float-end" aria-label="Delete"
                   style="font-size: 1.5rem; text-decoration: none; color: red;">
                </a>
                <div class="small mt-2">
                    By <b>{{ $comment->user->name }}</b>,
                    {{ $comment->created_at->diffForHumans() }}
                </div>
            </li>
        @endforeach
    </ul>

    <form action="{{ url('/comments/add') }}" method="post">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
        <input type="submit" value="Add Comment" class="btn btn-secondary">
    </form>
</div>
@endsection
