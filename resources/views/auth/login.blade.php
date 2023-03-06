@extends('layouts.app')

@section('title') Login @endsection

@section('main')
    <div class="form login bg-white p-3 shadow rounded-3 mx-auto mt-4">
        <x-messages />
        <form action="{{ route('user-auth') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group mb-3 d-flex justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" name="remember_token" type="checkbox" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Remember me
                    </label>
                </div>  
                <a href="{{ route('register') }}" class="">
                    Create an account?
                </a>                
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-sm bg-dark text-white">Login</button>
            </div>
        </form>
    </div>
@endsection