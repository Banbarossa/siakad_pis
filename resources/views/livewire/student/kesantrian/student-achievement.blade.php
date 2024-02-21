<div class="content">


    <ol class="relative border-gray-200 border-s dark:border-gray-700">
        @forelse($achievements as $item)
            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                </div>
                <time
                    class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->format('d F Y') }}
                </time>
                <h3 class="text-lg font-semibold text-gray-900 uppercase dark:text-white">Tingkat :
                    {{ $item->tingkat }}
                </h3>
                <h3 class="text-base text-gray-900 uppercase dark:text-white">Juara :
                    {{ $item->peringkat }}
                </h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                    {{ $item->deskripsi }}
                </p>
            </li>
        @empty
        <li class="mb-10 ms-4">
            <div
                class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <div class="text-gray-800 dark:text-gray-50">
                Belum Ada Data Yang ditemukan
            </div>
        </li>
        @endforelse
    </ol>
    
    
    
    <!-- Modal toggle -->
    
      
    
    
    
    
    
    
    
    </div>
    