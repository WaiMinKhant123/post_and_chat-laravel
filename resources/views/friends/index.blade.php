@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Friends</h1>

    <ul class="list-group">
        @forelse($friends as $friend)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="{{ url("/profileU/$friend->id") }}" class="text-decoration-none" style="color:black;">
                        <img src="{{ $friend->avatar ? '/avatars/' . $friend->avatar : 'https://via.placeholder.com/150' }}" class="rounded-circle me-2" style="width: 40px; height: 40px;" alt="{{ $friend->avatar }}">
                       <b> {{ $friend->name }}</b>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ url("/chat/messages/$friend->id") }}" class="btn btn-sm btn-success">Chat</a>
                    <form action="{{ route('user.unfollow', $friend) }}" method="POST" onsubmit="return confirm('Are you sure you want to unfollow?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Unfollow</button>
                    </form>
                </div>
            </li>
        @empty                  
            <li class="list-group-item">You have no friends yet.</li>
        @endforelse
    </ul>
</div>
@endsection
