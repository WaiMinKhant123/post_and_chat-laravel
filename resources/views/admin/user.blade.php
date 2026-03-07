@extends('layouts.appAdmin')

@section('content')
<style>
    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #dee2e6;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f8f9fa;
    }

    .name-cell {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
        line-height: 1.2em;
        max-height: 2.4em;
        word-break: break-word;
    }
</style>

<div class="container">
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ url('/admin/user') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Search by name" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- User Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Posts</th>
                    <th>Followers</th>
                    <th colspan='3'>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{ $user->avatar ? '/avatars/' . $user->avatar : 'https://via.placeholder.com/150' }}" class="rounded-circle" style="width: 40px; height: 40px;" alt="{{ $user->avatar }}">
                    </td>
                    <td class="name-cell">
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->posts_count }}
                    </td>
                    <td>
                        {{ $user->follower_count }}
                    </td>
                    <td>
                        <a href="{{ url("/chat/messages/{$user->id}") }}" class="btn btn-sm btn-success">Message</a>
                    </td>
                    <td>
                        @if($user->is_admin)
                            <button class="btn btn-sm btn-secondary" disabled>Admin</button>
                        @else
                            <form action="{{ route('user.promote', $user->id) }}" method="POST" class="promote-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">Promote to Admin</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if($user->banned)
                            <form action="{{ route('user.unban', $user->id) }}" method="POST" class="ban-unban-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Unban</button>
                            </form>
                        @else
                            <form action="{{ route('user.ban', $user->id) }}" method="POST" class="ban-unban-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Ban</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('submit', '.promote-form', function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var button = form.find('button');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                alert(response);
                button.prop('disabled', true).text('Admin');
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });

    $(document).on('submit', '.ban-unban-form', function(event) {
        event.preventDefault();

        var form = $(this);
        var url = @extends('layouts.appAdmin')

@section('content')
<style>
    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #dee2e6;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f8f9fa;
    }

    .name-cell {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
        line-height: 1.2em;
        max-height: 2.4em;
        word-break: break-word;
    }
</style>

<div class="container">
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ url('/admin/user') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Search by name" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- User Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Posts</th>
                    <th>Followers</th>
                    <th colspan='3'>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{ $user->avatar ? '/avatars/' . $user->avatar : 'https://via.placeholder.com/150' }}" class="rounded-circle" style="width: 40px; height: 40px;" alt="{{ $user->avatar }}">
                    </td>
                    <td class="name-cell">
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->posts_count }}
                    </td>
                    <td>
                        {{ $user->follower_count }}
                    </td>
                   
                    <td>
                        @if($user->is_admin)
                        <form action="{{ route('user.demote', $user->id) }}" method="POST" class="demote-form">
                        @csrf
                            <button type="submit" class="btn btn-sm btn-warning">unroll Admin</button>
                                </form>
                                    @else
                                
                            <form action="{{ route('user.promote', $user->id) }}" method="POST" class="promote-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">Promote to Admin</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if($user->banned)
                            <form action="{{ route('user.unban', $user->id) }}" method="POST" class="ban-unban-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Unban</button>
                            </form>
                        @else
                            <form action="{{ route('user.ban', $user->id) }}" method="POST" class="ban-unban-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Ban</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('submit', '.promote-form', function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var button = form.find('button');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                alert(response);
                button.prop('disabled', true).text('Admin');
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });

    $(document).on('submit', '.ban-unban-form', function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var button = form.find('button');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                // Update button text based on the response
                if (button.text().trim() === 'Ban') {
                    button.text('Unban').removeClass('btn-danger').addClass('btn-success');
                } else {
                    button.text('Ban').removeClass('btn-success').addClass('btn-danger');
                }
                alert(response);
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection
form.attr('action');
        var method = form.attr('method');
        var button = form.find('button');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                if (button.text().trim() === 'Ban') {
                    button.text('Unban').removeClass('btn-danger').addClass('btn-success');
                } else {
                    button.text('Ban').removeClass('btn-success').addClass('btn-danger');
                }
                alert(response);
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });
    // resources/js/app.js

$(document).on('submit', '.demote-form', function(event) {
    event.preventDefault();

    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var button = form.find('button');

    $.ajax({
        url: url,
        type: method,
        data: form.serialize(),
        success: function(response) {
            alert(response);
            button.prop('disabled', true).text('Not Admin');
        },
        error: function(xhr) {
            alert('An error occurred: ' + xhr.responseText);
        }
    });
});

</script>
@endsection
