<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App | Login</title>
</head>
<body>
@extends('layouts.master')

@section('content')
    <div>
        @if (session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif
         @if (session('error'))
            <p style="color:red;">{{ session('error') }}</p>
        @endif
    </div>
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p>Don't have an account? <a href="{{ route('signup') }}">Sign up</a></p>
@endsection

</body>
</html>