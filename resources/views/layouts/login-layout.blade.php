<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'SIAKAD PIS' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-white dark:bg-gray-800">

        @include('layouts.part.login-navigation')
        {{ $slot }}
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        {{-- @include('layouts.js') --}}
        {{-- <script>
            


            // Dark Mode
            const toggleBtn = document.getElementById("toggle-btn");
            const darkToggle = document.getElementById("dark-toggle");
            const theme = document.querySelector('html');
            let darkMode = localStorage.getItem("dark-mode");

            const enableDarkMode = () => {
            theme.classList.add("dark");
            toggleBtn.innerHTML =`<i id="dark-toggle" class="mr-2 text-white fas fa-sun"></i>`;
            localStorage.setItem("dark-mode", "enabled");
            console.log(darkToggle.classList)
            };

            const disableDarkMode = () => {
            theme.classList.remove("dark");
            toggleBtn.innerHTML =`<i id="dark-toggle" class="mr-2 fas fa-moon"></i>`
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
        </script> --}}
        {{-- <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $('.no_hp').mask('+62 000-0000-0000')
            $('#nisn').mask('9999999999')
        </script> --}}
        
    </body>
</html>
