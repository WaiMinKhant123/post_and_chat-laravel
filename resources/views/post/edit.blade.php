<!-- In resources/views/post/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>

    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST') <!-- or @method('PUT') if you're using PUT requests -->

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body" rows="5" required>{{ $post->body }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category['id'] }}" {{ $category['id'] == $post->category_id ? 'selected' : '' }}>
                        {{ $category['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="media_files" class="form-label">Media Files</label>
            <input type="file" class="form-control" id="media_files" name="media_files[]" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
