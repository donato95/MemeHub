@extends('layouts.app')

@section('title') {{ $post->title }} @endsection

@section('main')
    <div class="container">
        <a href="{{ route('home') }}" class="my-2 btn btn-sm btn-outline-primary">BACK</a>
        <div class="row">
            <div class="col-md-3 author">
                <div class="bg-white p-2 rounded-3 text-center">
                    <div class="image mx-auto w-40">
                        <img 
                            class="w-100 rounded-circle"
                            src="{{ $post->user->image ? asset('storage/'.$post->user->image): asset('images/avatar.jpg') }}" alt=""
                            />
                    </div>
                    <div class="about">
                        <h5>{{ $post->user->name }}</h5>
                        <p class="text-sm">
                            {{ $post->user->bio }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <x-messages />
                <livewire:show-post :post="$post" />
            </div>
        </div>
    </div>
@endsection