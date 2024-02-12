<nav
    class="fixed bg-gradient-to-tr from-red-50 to-gray-50 dark:bg-gradient-to-tr dark:from-gray-900 dark:to-gray-900 w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://siakad.pis.sch.id" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/favicon.ico') }}" class="h-8" alt="pis Logo">
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

            <button class="mr-4" id="toggle-btn" x-data="{darkMode: localStorage.getItem('dark-mode')== 'enabled'}">
                <i id='dark-toggle' class="fas fa-moon mr-2"></i>
                <i class="fas fa-sun text-white mr-2" x-show="darkMode"></i>
            </button>


            <button type="button"
                class="hidden md:block text-white bg-gradient-to-tr from-red-950 via-orange-900 to-red-900 hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full shadow-lg text-sm px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Get
                started</button>

            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 0 dark:border-gray-700">
                <li class="mb-3 md:mb-0">
                    <x-nav-link :href="route('welcome')" :active="Request::routeIs('welcome')">Home</x-nav-link>
                </li>
                <li class="mb-4 md:mb-0">
                    <x-nav-link :href="route('find.santri')" :active="Request::routeIs('find.santri')">Pencarian Data</x-nav-link>
                </li>
                
            </ul>
        </div>
    </div>
</nav>


