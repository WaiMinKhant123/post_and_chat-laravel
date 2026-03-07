@extends('layouts.app')

@section('content')
<style>
    .blocked-user-list {
        margin: 20px auto;
        max-width: 600px;
    }

    .blocked-user-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .blocked-user-item img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .blocked-user-item button {
        margin-left: auto;
    }
</style>

<div class="container blocked-user-list">
    <h2 class="text-center">Blocked Users</h2>
    @if($blockedUsers->isEmpty())
        <p class="text-center">You have not blocked any users.</p>
    @else
        @foreach($blockedUsers as $user)
            <div class="blocked-user-item">
                <div class="d-flex align-items-center">
                    <img src="{{ $user->avatar ? '/avatars/' . $user->avatar : 'https://via.placeholder.com/150' }}" alt="{{ $user->name }}">
                    <div>
                        <a href="{{ url("/profileU/{$user->id}") }}" class="text-decoration-none"><b>{{ $user->name }}</b></a>
                    </div>
                </div>
                <form action="{{ route('user.unblock', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Unblock</button>
                </form>
            </div>
        @endforeach
    @endif
</div>
@endsection
