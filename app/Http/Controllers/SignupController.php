<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate(
            [
                'fname' => 'required|string',
                'mname' => 'nullable|string',
                'lname' => 'required|string',
                'city' => 'required|string',
                'country' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ],
            [
                'fname.required' => 'First Name is required',
                'mname.string' => 'Middle Name must be a string',
                'lname.required' => 'Last Name is required',
                'city.required' => 'City is required',
                'country.required' => 'Country is required',
                'city.string' => 'City must be a string',
                'country.string' => 'Country must be a string',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email address',
                'email.unique' => 'Email already exists',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 8 characters',
                'password.confirmed' => 'Passwords does not match',
            ]
        );

        //dd($request->all());

        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $pass = $request->input('password');
        $country = $request->input('country');
        $city = $request->input('city');

        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

        //database transaction
        DB::beginTransaction();
        try {

            $password = new Password();
            $password->hash = $hashedPassword;
            $password->save();

            $user = new UserProfile();
            $user->email = $email;
            $user->fname = ucwords(strtolower($fname));
            $user->lname = ucwords(strtolower($lname));
            $user->country = ucwords(strtolower($country));
            $user->city = ucwords(strtolower($city));
            $user->password_id = $password->id;
            $user->save();

            DB::commit();

            return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
    }
}
