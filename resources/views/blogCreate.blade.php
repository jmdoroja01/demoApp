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
      <a class="btn btn-primary btn-sm" href="{{ route('blogs') }}">Go to blogs</a>
      <form class="p-1 m-0" action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-primary btn-sm" type="submit">Logout</button>
      </form>
    </span>
  </div>
  <section class="p-4">
    <h5>Welcome, {{ session('user')->fname }} {{ session('user')->lname }}!</h5>
    @if (session('success'))
    <div>
      <p style="color: green;">{{ session('success') }}</p>
    </div>
    @endif
    <div class="container shadow-lg p-2">
      <h4>Create a New Blog Post:</h4>
      <form action="{{ route('blog.create') }}" method="POST">
        @csrf
        <div class="mb-1">
          <label for="title">Title:</label>
          <input class="form-control" type="text" id="title" name="title" required>
        </div>
        <div class="mb-1">
          <label for="content">Content:</label>
          <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Post Blog</button>
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
  <section class="p-4">
    <div style="max-height: 300px; overflow-y: auto;">
      <h5>Your Blogs:</h5>
      @foreach ($blogs as $blog)
      <div class="container shadow rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-center">
          <h4>{{ $blog->title }}</h4>
          <span>
            <form action="{{route('blog.destroy')}}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <input type="hidden" value="{{$blog->id}}" name="id">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <form action="{{route('blog.edit.show')}}" method="GET" class="d-inline">
              <input type="hidden" value="{{$blog->id}}" name="id">
              <button type="submit" class="btn btn-primary">Edit</button>
            </form>
          </span>
        </div>
        <p>{{$blog->user->fname}} {{$blog->user->lname}} | {{$blog->user->city}}, {{$blog->user->country}}</p>
        <p>{{ $blog->content }}</p>
      </div>
      @endforeach
    </div>
  </section>
  @endsection
</body>

</html>