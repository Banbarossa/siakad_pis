<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name','laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('lte/plugins/fontawesome-free/css/all.min.css')}}">
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <main class="w-full align-middle min-h-svh bg-gradient-to-b from-indigo-400 via-orange-500 to-red-300">
            <div class="w-full h-full">
                <x-guest-card class="w-full">
                <div class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mx-auto text-red-500" fill="currentColor" viewBox="0 0 512 512"><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/></svg>


    
                    <h5 class="mt-16 mb-5 text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-800 to-red-700 md:text-4xl dark:text-white">Surat Yang Anda Cari Tidak Ditemukan</h5>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 max-w-[640px] mb-2.5 mx-auto"></div>
                    <div class="h-2.5 mx-auto bg-gray-300 rounded-full dark:bg-gray-700 max-w-[540px]"></div>
                    <p class="mt-5 mb-5 text-base text-gray-500 sm:text-xl dark:text-gray-400">
                        Silahkan laporkan penyalahgunaan surah ke email resmi di 
                    </p>
                </div>
            </x-guest-card>
            </div>
            




            
            
            
            
            
  
        </main>

        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts />




    </body>
</html>
