<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if(session('logged_in')){
            return redirect()->route('blog');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],
        [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        //dd($request->all());

        $user = UserProfile::where('email', $email)->first();

        if(!$user){
            return back()->withErrors(['error' => 'Email does not exist.'])->withInput();
        }

        $passwordId = $user->password_id;

        $hash = Password::find($passwordId);

        //dd($hash);

        if($user && $hash && password_verify($password, $hash->hash)){
            session([
                'user' => $user,
                'logged_in' => true,
                'login_success' => 'Login successful. Welcome back!'
            ]);

            return redirect()->route('blogs');
        } else {
            return back()->withErrors(['error' => 'Invalid email or password'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('logout_success', 'You have been logged out successfully.');
    }
}
