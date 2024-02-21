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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            
            <livewire:layouts.student-navbar/>
            <livewire:layouts.student-sidebar/>
            
            
            
            <div class="p-4 sm:ml-64 bg-slate-200 dark:bg-gray-700 min-h-dvh">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
  
        </div>



        <script>
            const toggleBtn = document.getElementById("toggle-btn");
            const darkToggle = document.getElementById("dark-toggle");
            const theme = document.querySelector('html');
            let darkMode = localStorage.getItem("dark-mode");

            const enableDarkMode = () => {
                theme.classList.add("dark");
                toggleBtn.innerHTML = `<i id="dark-toggle" class="mr-2 text-white fas fa-sun"></i>`;
                localStorage.setItem("dark-mode", "enabled");
                console.log(darkToggle.classList)
            };

            const disableDarkMode = () => {
                theme.classList.remove("dark");
                toggleBtn.innerHTML = `<i id="dark-toggle" class="mr-2 fas fa-moon"></i>`
                localStorage.setItem("dark-mode", "disabled");
                console.log(darkToggle.classList)
            };

            if (darkMode === "enabled") {
                enableDarkMode();
            }

            toggleBtn.addEventListener("click", (e) => {
                darkMode = localStorage.getItem("dark-mode");
                if (darkMode === "disabled") {
                    enableDarkMode();
                } else {
                    disableDarkMode();
                }
            });

        </script>
    </body>
</html>
