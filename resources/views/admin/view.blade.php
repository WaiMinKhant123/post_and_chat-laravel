@extends('layouts.appAdmin')

@section('content')
<div class="container mt-5">
    <!-- Search Form -->
    <form method="GET" action="{{ url('/admin/view') }}" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search by title" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Posts Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($post as $posts)
                <tr>
                    <td class="text-break">
                        {{ $posts->title }}
                    </td>
                    <td>
                        <!-- Delete Button -->
                        <a class="btn btn-warning btn-sm" href="{{ url('/admin/delete/' . $posts->id) }}" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

@endsection
