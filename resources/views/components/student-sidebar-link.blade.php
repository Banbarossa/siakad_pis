@props(['active','href'])

@php
    $classes = ($active ?? false)
    ?'flex items-center p-2 text-gray-500 rounded-lg dark:text-gray-900 bg-gradient-to-r from-indigo-300 to-red-100  group'
    :'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group'
@endphp

<li>
    <a href="{{ $href }}" {{ $attributes->merge(['class'=>$classes]) }}>
        {{ $slot }}
    </a>
</li>