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
            <h5 class="font-weight-bold mb-3 text-center text-lg-start">Members</h5>

            <!-- Search Form -->
            <form method="GET" action="{{ route('chat.index') }}" class="mb-4">
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
                                <a href="{{ url('/profileU/'.$user->id) }}" class="d-flex justify-content-between text-decoration-none" style="color :black;">
                                    <div class="d-flex flex-row position-relative">
                                        <img src="{{ $user->avatar ? '/avatars/' . $user->avatar : 'https://via.placeholder.com/150' }}" class="rounded-circle" style="width: 40px; height: 40px;" alt="{{ $user->avatar }}">
                                        &nbsp; &nbsp;
                                        <div class="pt-1">
                                            <p class="fw-bold mb-0"><b>{{ $user->name }}</b></p>
                                        </div>
                                    
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


@endsection
