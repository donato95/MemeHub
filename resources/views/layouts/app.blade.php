<!DOCTYPE html>

@php($lang = App::currentLocale())

<html @if($lang == 'en') lang='en' dir="ltr" @else lang='ar' dir='rtl'@endif>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ $lang == 'ar' ? asset('css/arabic.css'): '' }}">
        @livewireStyles
        <title>@yield('title')</title>
    </head>
    <body class="container-fluid">
        

        <main>
            @yield('main')
        </main>

        <div class="settings container position-absolute d-flex flex-column">
            <a 
                href="{{ route('switch', ['lang'=>App::currentLocale(), 'language'=>'ar']) }}" 
                class="mb-2 d-block">
                <img 
                    src="{{ asset('images/arabic.png') }}" 
                    class="rounded-circle" width="30px" height="30px">
            </a>
            <a 
                href="{{ route('switch', ['lang'=>App::currentLocale(), 'language'=>'en']) }}" 
                class="mb-2 d-block">
                <img 
                    src="{{ asset('images/english.png') }}" 
                    class="rounded-circle" width="30px" height="30px"/>
            </a>
            @auth
            <a href="{{ route('logout', ['lang'=>App::currentLocale()]) }}" class="d-block">
                <img src="{{ asset('images/logout.png') }}" class="" width="30px" height="30px"/>
            </a>
            @endauth
        </div>

        {{-- Bootstrap Js --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        
        {{-- Livewire Scripts --}}
        @livewireScripts
    </body>
</html>