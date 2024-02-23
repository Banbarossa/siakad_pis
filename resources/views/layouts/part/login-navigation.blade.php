<nav
    class="fixed top-0 z-20 w-full border-b border-gray-200 bg-gradient-to-tr from-red-50 to-gray-50 dark:bg-gradient-to-tr dark:from-gray-900 dark:to-gray-900 start-0 dark:border-gray-600">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
        <a href="https://siakad.pis.sch.id" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/favicon.ico') }}" class="h-8" alt="pis Logo">
        </a>
        <div class="flex space-x-3 md:order-2 md:space-x-0 rtl:space-x-reverse">

            <button class="mr-4" id="toggle-btn" x-data="{darkMode: localStorage.getItem('dark-mode')== 'enabled'}">
                <i id='dark-toggle' class="mr-2 fas fa-moon"></i>
                <i class="mr-2 text-white fas fa-sun" x-show="darkMode"></i>
            </button>

            <a href="http://pis.sch.id" target="_blank" rel="noopener noreferrer" class="hidden px-4 py-2 text-sm font-medium text-center text-white rounded-full shadow-lg md:block bg-gradient-to-tr from-red-950 via-orange-900 to-red-900 hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Tentang Kami
            </a>



            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
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
            <ul class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 0 dark:border-gray-700">
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


