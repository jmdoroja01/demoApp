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
            <a class="btn btn-primary btn-sm" href="{{ route('blog.create.show') }}">Go back</a>
            <form class="p-1 m-0" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-primary btn-sm" type="submit">Logout</button>
            </form>
        </span>
    </div>
    <section>
        <div class="container shadow-lg p-2">
            <h4>Edit your blog post:</h4>
            <form action="{{ route('blog.edit') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $blogs->id }}" name="id">
                <div class="mb-1">
                    <label for="title">Title:</label>
                    <input class="form-control" type="text" id="title" name="title" value="{{$blogs->title}}" required>
                </div>
                <div class="mb-1">
                    <label for="content">Content:</label>
                    <textarea class="form-control" id="content" name="content" rows="4" required>{{ $blogs->content }}</textarea>
                </div>
                <button class="btn btn-primary" type="submit">Edit Blog</button>
            </form>
            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>
    @endsection
</body>

</html>