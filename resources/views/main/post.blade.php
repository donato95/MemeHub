@extends('layouts.app')

@section('title') Home @endsection

@section('main')
    <div class="container">
        <div class="row my-4">
            <div class="col-md-3">
                <div class="bg-white p-2 rounded-3">
                    test
                </div>
            </div>
            <x-post :post="$post" />
        </div>
    </div>
@endsection