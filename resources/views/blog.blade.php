<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App | Blogs</title>
</head>

<body>
    @extends('layouts.master')
    @section('content')
    <div class="container d-flex justify-content-between align-items-center">
        <h1>Blogs</h1>
        <span class="d-flex align-items-center">
            <a class="btn btn-primary btn-sm" href="{{ route('blog.create.show') }}">Create New Blog</a>
            <form class="p-1 m-0" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-primary btn-sm" type="submit">Logout</button>
            </form>
        </span>
    </div>
    <div class="container w-50 justify-content-center align-items-center">
        @if (session('login_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('login_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <section class="p-4">
        <h5>Welcome, {{ session('user')->fname }} {{ session('user')->lname }}!</h5>
        <h5>Blogs:</h5>
        <div style="max-height: 300px; overflow-y: auto;">
            @forelse ($blogs as $blog)
            <div class="container shadow rounded-3 p-3">
                <h4>{{ $blog->title }}</h4>
                <p>{{$blog->user->fname}} {{$blog->user->lname}} | {{$blog->user->city}}, {{$blog->user->country}}</p>
                <p>{{ $blog->content }}</p>
                <div>
                    <p>Comments:</p>
                    <div>
                        <form action="" method="POST">
                            <div class="d-flex justify-content-between align-items-center">
                                <textarea class="form-control mb-2 me-2" name="comment" id="comment" placeholder="Add a comment..."></textarea>
                                <button type="submit" class="btn btn-primary btn-sm mb-2">Add Comment</button>
                            </div>
                        </form>
                    </div>
                    <div class="container shadow rounded-3 p-2">
                        <p>sample comment</p>
                    </div>
                </div>
            </div>
            @empty
            <p>No blogs available.</p>
            @endforelse
        </div>
    </section>
    @endsection
</body>

</html>