<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show user login form page
    public function login() {
        return view('auth.login');
    }

    // Authenticate user 
    public function auth(Request $request) {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->with('danger', 'Wrong credentials')->onlyInput('email'); 
    }

    // Show user registeration form page
    public function register() {
        return view('auth.register');
    }

    // Register new user
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'string', Rule::unique('users', 'email')],
            'username' => ['required', 'string', Rule::unique('users', 'username'), 'max:15', 'min:4'],
            'password' => 'required|string|confirmed',
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
        auth()->login($user);
        return redirect()->route('home')->with('message', 'Welcome to Memehub');
    }

    public function logout(Request  $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
