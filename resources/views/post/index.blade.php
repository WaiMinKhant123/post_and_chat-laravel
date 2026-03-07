<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/blogs/blog-5/assets/css/blog-5.css">
    <title>Document</title>
    <style>
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .text-wrap {
            word-wrap: break-word;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .col-12{
          background-color: #E0E0E0;
          border: 2px solid white;
          color: white;
          padding: 10px;
        }
        
    </style>
</head>
<body style="background-color: #212121; color: white;">
@extends("layouts.app")
@section("content")
  <div class="container overflow-hidden">
    <!-- Search Form -->
    <form method="GET" action="{{ route('post.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    
    <div class="row gy-4 gy-md-5 gx-xl-6 gy-xl-6 gx-xxl-9 gy-xxl-9">
      @if(session('info'))
      <div class="alert alert-info">
        {{ session('info') }}
      </div>
      @endif
      @foreach($post as $posts)
      <div class="col-12 col-sm-5 col-md-4 col-lg-3 mb-4">
        <article>
          <div class="card border-0 bg-transparent rounded-circle">
            <figure class="card-img-top mb-4 overflow-hidden bsb-overlay-hover">
              <a href="{{ url("/post/readmore/$posts->id") }}">
                @if($posts->media->isNotEmpty())
                  @if(strpos($posts->media->first()->file_type, 'video') !== false)
                    <video width="100%" height="400px" controls>
                      <source src="{{ asset('storage/' . $posts->media->first()->file_path) }}" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                  @else
                    <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="{{ asset('storage/' . $posts->media->first()->file_path) }}" alt="{{ asset('storage/' . $posts->media->first()->file_path) }}" style="width: 100%; height: 400px;">
                  @endif
                @else
                  <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="{{ asset('img/download1.jpg') }}" alt="Default Image" width="100%" height="auto">
                @endif
              </a>
              <figcaption>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                </svg>
                <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Read More</h4>
              </figcaption>
            </figure>
            <div class="card-body m-0 p-0">
              <div class="entry-header mb-3">
                <ul class="entry-meta list-unstyled d-flex mb-3">
                  <li>
                    <a class="d-inline-flex px-2 py-1 link-primary text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-2 text-decoration-none fs-7" href="#!">{{ $posts->category->name}}</a>
                  </li>
                </ul>
                <h2 class="card-title entry-title h4 m-0">
                  <a class="link-dark text-decoration-none" href="#!">{{ $posts['title'] }}</a>
                </h2>
              </div>
            </div>
            <div class="card-footer border-0 bg-transparent p-0 m-0">
              <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                <li>
                  <img src="{{ $posts->user && $posts->user->avatar ? '/avatars/' . $posts->user->avatar : '/path/to/default/avatar.png' }}" class="rounded-circle" style="width: 50px; height: 50px;">
                </li>
                <li>
                  <a href="{{ url("/profileU/{$posts->user->id}") }}" class="text-decoration-none">
                    <span class="ms-2 fs-7 text-muted">
                      {{ strlen($posts->user ? $posts->user->name : 'Unknown User') > 9 ? substr($posts->user ? $posts->user->name : 'Unknown User', 0, 9) . '...' : ($posts->user ? $posts->user->name : 'Unknown User') }}
                    </span>
                  </a>
                </li>
                <li>
                  <span class="px-3">&bull;</span>
                </li>
                <li>
                  <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center" href="#!">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                      <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                      <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                    <span class="ms-2">{{ $posts->created_at->diffForHumans()}}</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </article>
      </div>
      @endforeach
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9lbQdNMycK6nEzM6Mx6J7LkLxfkGxLcmSO7e2F0n2f7bRXV58fE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cj6Gz5b7p3r8x4hz6jchO9LUJ4t6mN9mF8SyjUpvZ5W1ey7hG0eaeQK8x8e6bL84" crossorigin="anonymous"></script>
@endsection
</body>
</html>
