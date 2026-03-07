@extends("layouts.app")

@section("content")
<div class="container">
    @if($errors->any())
        <div class="alert alert-warning">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('post.createAndUpload') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Post Details -->
    <div class="mb-3">
    <input type="hidden" name="user_id" value="{{ Auth::id()}}">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea id="body" name="body" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select id="category_id" name="category_id" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category['id'] }}">
                    {{ $category['name'] }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Media Upload -->
    <div class="mb-3">
        <label for="media_files" class="form-label">Upload Images/Videos</label>
        <input type="file" id="media_files" name="media_files[]" multiple class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection
