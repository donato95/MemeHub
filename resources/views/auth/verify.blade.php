@extends('layouts.app')

@section('title') {{ __('messages.verify') }} @endsection

@section('main')
    <div class="form login bg-white p-3 shadow rounded-3 mx-auto mt-4">
        <x-messages />
        <form action="{{ route('verify-email', App::getLocale()) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">{{ __('messages.email') }}</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-sm bg-dark text-white">
                    {{ __('messages.send') }}
                </button>
            </div>
        </form>
    </div>
@endsection