@props(['type'=>'button'])



<button type="{{ $type }}" {{ $attributes->merge(['class' => 'hidden md:block text-white bg-gradient-to-tr from-red-950 via-orange-900 to-red-900 hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full shadow-lg text-sm px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800']) }}>
    {{ $slot }}
</button>
