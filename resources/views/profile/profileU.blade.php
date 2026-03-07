@extends('layouts.app')

@section('content')
    <style>
       body {
           background-color: #212121;
       }
       .profile-card {
           max-width: 400px;
           margin: 20px auto;
           border-radius: 10px;
           box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
           background-color: #fff;
           padding: 20px;
           box-sizing: border-box;
       }
       .profile-image {
           border-radius: 10%;
       }
       .profile-header {
           padding: 20px;
           text-align: center;
       }
       .profile-header h2 {
           word-break: break-word;
           overflow-wrap: break-word;
       }
       .stats {
           border-top: 1px solid #dee2e6;
           border-bottom: 1px solid #dee2e6;
           padding: 20px;
       }
       .stats div {
           font-size: 16px;
       }
       .button-group {
           display: flex;
           gap: 10px;
           margin: 20px;
           justify-content: space-between;
       }
       .button-group .btn {
           flex: 1;
           text-align: center;
           min-width: 100px;
       }
    </style>

    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <img src="{{ $user->avatar ? '/avatars/' . $user->avatar : 'https://via.placeholder.com/150' }}" alt="Profile Image" class="profile-image img-fluid" width="150">
                <h2 class="mt-3">{{ $user->name }}</h2>
            </div>
            <div class="stats d-flex justify-content-around">
                <div class="text-center">
                    <h5>Posts</h5>
                    <p class="mb-0">{{ $user->posts_count }}</p>
                </div>
                <div class="text-center">
                    <h5>Followers</h5>
                    <p class="mb-0">{{ $followerCount }}</p>
                </div>
            </div>
            <div class="button-group">
                @if(Auth::check())
                    @if ($isFollowing)
                        <form action="{{ route('user.unfollow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('user.follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                    @endif

                    @if (Auth::user()->isBlocked($user->id))
                        <form action="{{ route('user.unblock', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Unblock</button>
                        </form>
                    @else
                        <form action="{{ route('user.block', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Block</button>
                        </form>
                    @endif
                @else
                    <button class="btn btn-primary" disabled>Follow</button>
                @endif
                <a href="{{ url("/chat/messages/$user->id") }}" class="btn btn-secondary">Chat</a>
            </div>
            <br><br><br>
        </div>
    </div>
@endsection
