@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-red-900 text-base font-bold leading-5 text-red-900 dark:text-gray-100 focus:outline-none focus:border-red-900 dark:border-gray-100 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-base  font-medium dark:font-thin leading-5 text-red-900 dark:text-gray-300 hover:text-red-700 hover:border-red-300 dark:hover:border-gray-300 focus:outline-none focus:text-red-700 focus:border-dark-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
