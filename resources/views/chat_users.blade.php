<!-- resources/views/chat_users.blade.php -->

@extends('layouts.app')

@section('content')
<style>
    .list-unstyled p {
        word-break: break-word; 
        overflow-wrap: break-word;
    }
    .badge {
        display: none; /* Initially hide the badge */
    }
    .badge.d-none {
        display: none;
    }
    .badge:not(.d-none) {
        display: inline;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
            <h5 class="font-weight-bold mb-3 text-center text-lg-start">Active Conversations</h5>

            <!-- Search Form -->
            <form method="GET" action="{{ route('chat.active') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>

            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @foreach($users as $user)
                            <li class="p-2 border-bottom">
                                <a href="{{ url('/chat/messages/'.$user->id) }}" class="d-flex justify-content-between text-decoration-none" style="color :black;">
                                    <div class="d-flex flex-row position-relative">
                                        <img src="{{ $user->avatar ? '/avatars/' . $user->avatar : 'https://via.placeholder.com/150' }}" class="rounded-circle" style="width: 40px; height: 40px;" alt="{{ $user->avatar }}">
                                        &nbsp; &nbsp;
                                        <div class="pt-1">
                                            <p class="fw-bold mb-0"><b>{{ $user->name }}</b></p>
                                        </div>
                                        <span id="badge-{{ $user->id }}" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
                                            0
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateUnreadCounts() {
        fetch('{{ route('unread.counts.by.sender') }}')
            .then(response => response.json())
            .then(data => {
                console.log('Unread counts by sender:', data);
                Object.keys(data).forEach(userId => {
                    const badge = document.getElementById('badge-' + userId);
                    const count = data[userId];
                    if (badge) {
                        if (count > 0) {
                            badge.textContent = count > 99 ? '99+' : count;
                            badge.classList.remove('d-none');
                        } else {
                            badge.textContent = '';
                            badge.classList.add('d-none');
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching unread counts:', error));
    }

    // Update the unread counts on page load
    updateUnreadCounts();

    // Optionally, set up a polling interval if you want to update periodically
    // setInterval(updateUnreadCounts, 60000); // Update every 60 seconds
});
</script>
@endsection
