<div class="p-8 bg-white rounded-lg dark:bg-gray-800 dark:text-gray-100">
    <div role="status">
        <div  class="animate-pulse">
            <div class="w-full mx-auto mb-6 text-2xl text-center md:text-4xl">
                {{ __('Assalamualaikum, ') }} <span class="font-extrabold text-transparent uppercase bg-gradient-to-r bg-clip-text from-green-500 via-indigo-400 to-red-300">{{ Auth::user()->name }}</span>
            </div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 max-w-[640px] mb-2.5 mx-auto"></div>
            <div class="h-2.5 mx-auto bg-gray-300 rounded-full dark:bg-gray-700 max-w-[540px]"></div>
            <div class="flex items-center justify-center mt-4"> </div>

        </div>

        {{ $slot }}
        
    <span class="sr-only">Loading...</span>
    </div>
</div>