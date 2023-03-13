@extends('layouts.app')

@section('title') Register @endsection

@section('main')
    <div class="form register bg-white p-3 shadow rounded-3 mx-auto mt-5">
        <form action="{{ route('store-user', App::getLocale()) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                @error('name')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" id="username" class="form-control">
                @error('username')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                @error('email')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password1" class="form-label">Confirm Password</label>
                <input type="password" id="password1" name="password_confirmation" class="form-control">
                @error('password_confirmation')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-sm bg-dark text-white">Register</button>
                <a href="{{ route('login', App::getLocale()) }}" class="">
                    Already have account?
                </a> 
            </div>
        </form>
    </div>
@endsection