<div class="content">


<ol class="relative border-gray-200 border-s dark:border-gray-700">
    @forelse($pelanggaran as $item)
        <li class="mb-10 ms-4">
            <div
                class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <time
                class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->format('d F Y') }}
                <span class="text-xs text-gray-500">{{ $item->jam }}</span></time>
            <h3 class="text-lg font-semibold text-gray-900 uppercase dark:text-white">Kategori :
                {{ $item->level_pelanggaran }}</h3>
            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                {{ strlen($item->deskripsi) > 50 ? substr($item->deskripsi ,0,50):$item->deskripsi }}
            </p>
            <button wire:click="getDetail({{ $item->id }})" data-modal-target="progress-modal" data-modal-toggle="progress-modal" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                type="button">
                selengkapnya
                <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </button>
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

  
  <!-- Main modal -->
  <div id="progress-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" wire:ignore.self>
      <div class="relative w-full max-w-md max-h-full p-4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="progress-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5">
                    <svg class="w-10 h-10 mb-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V43.5c0 49.9-60.3 74.9-95.6 39.6L120.2 75C107.7 62.5 87.5 62.5 75 75s-12.5 32.8 0 45.3l8.2 8.2C118.4 163.7 93.4 224 43.5 224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H43.5c49.9 0 74.9 60.3 39.6 95.6L75 391.8c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l8.2-8.2c35.3-35.3 95.6-10.3 95.6 39.6V480c0 17.7 14.3 32 32 32s32-14.3 32-32V468.5c0-49.9 60.3-74.9 95.6-39.6l8.2 8.2c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-8.2-8.2c-35.3-35.3-10.3-95.6 39.6-95.6H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H468.5c-49.9 0-74.9-60.3-39.6-95.6l8.2-8.2c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-8.2 8.2C348.3 118.4 288 93.4 288 43.5V32zM176 224a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm128 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                    <div class="mb-4">
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Detail Pelanggaran</h3>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">{{ $deskripsi }}<p>
                    </div>
                    <div class="mb-4">
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Penanganan</h3>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">{{ $penanganan }}<p>
                    </div>

                    <div class="text-lg font-gray-700 dark:text-white"> kategori : {{ $level_pelanggaran }}</div>

                    <div class="flex justify-between mt-4 text-gray-800 align-middle dark:text-slate-50">
                        <div>
                            {{ \Carbon\Carbon::parse($tanggal)->locale('id')->format('d F Y') }}
                            <div class="text-xs">{{ $jam }}</div>
                        </div>
                        <div class="text-red-700 dark:text-white">
                            Point :{{ $point }}
                        </div>
                        
                    </div>


                    <!-- Modal footer -->
                    <div class="flex items-center mt-6 space-x-4 rtl:space-x-reverse">
                        <button data-modal-hide="progress-modal" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                    </div>
                </div>
            </div>
          <!-- Modal content -->
          
      </div>
  </div> 
  








</div>
