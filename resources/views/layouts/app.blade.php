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

        <footer class="container bg-white rounded-3 text-center mt-4 p-4">
            <a href="{{ route('switch', ['lang'=>'ar']) }}" class="m-1">العربية</a>
            <a href="{{ route('switch', ['lang'=>'en']) }}" class="m-1">English</a>
        </footer>

        {{-- Bootstrap Js --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        
        {{-- Livewire Scripts --}}
        @livewireScripts
    </body>
</html>