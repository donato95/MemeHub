<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            return redirect()->route('home', App::getLocale());
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
        return redirect()->route('home', App::getLocale())->with('message', 'Welcome to Memehub');
    }

    public function verify() {
        return view('auth.verify');
    }

    public function send(Request $request) {
        $data = $request->validate(['email'=>'required|string|email']);
        $token = bin2hex($data['email']);
        $user = User::query()->where('email', $data['email'])->first();
        $user->update([
            'email_token' => $token,
        ]);
        Mail::to($data['email'])->send(new VerifyMail($user));
        return redirect()->route('home', App::getLocale())->with('success', 'Token been sent to your email');
    }

    public function verfication($lang, $token) {
        $user = User::query()->where('email_token', $token)->first();
        $user->update(['email_verify'=>1]);
        return redirect()->route('home', App::getLocale())->with('success', 'Email verified.');
    }

    public function logout(Request  $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home', App::getLocale());
    }
}
