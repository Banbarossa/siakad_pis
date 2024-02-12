<div {{ $attributes->merge(['class'=>'bg-gradient-to-br from-red-50 via-indigo-100 to-red-100 dark:bg-gradient-to-t dark:from-gray-900 dark:to-gray-800 relative']) }}>
    
    <div class="w-56 h-56 scale-150 bg-pink-200 absolute rounded-full blur-3xl opacity-20 dark:opacity-5" ></div>
    <div class="w-56 h-56 scale-150 bg-purple-200 left-1/2 top-1/2 absolute rounded-full blur-3xl opacity-20 dark:opacity-5"></div>
    <div class="max-w-screen-xl mx-auto pt-16 backdrop-filter backdrop-blur-md">
        
        <div class="min-h-screen">
            <div class="w-full max-w-screen-xl py-14">
                <div class="border-2 border-red-50 dark:border-gray-900 shadow-md rounded-2xl overflow-hidden">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>