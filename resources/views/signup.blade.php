<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App | Sign Up</title>
</head>
<body>
    @extends('layouts.master')
    @section('content')
    <h1>Sign Up</h1>
    <form action="{{ route('signup.post') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="{{ old('fname') }}"  required>
        </div>
        <div>
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="{{ old('lname') }}" required>
        </div>
        <div>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="{{ old('country') }}" required>
        </div>
        <div>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="{{ old('city') }}" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

</body>
</html>