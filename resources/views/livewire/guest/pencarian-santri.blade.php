<x-guest-card>
    <div class="p-8">

        <div>
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search " wire:model.live='search'
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukkan NISN atau Nomor Pendaftaran Anda Disini" required>
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Search</button>
            </div>
        </div>




        <div class="mt-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tahun Masuk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aktif
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        @forelse ($student as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{$item->nama}}</td>
                                <td class="px-6 py-4">{{$item->tahun_masuk}}</td>
                                <td class="px-6 py-4">
                                    @if ($item->is_aktif)
                                            <button class="btn btn-outline-success" disabled>Aktif</button>
                                        @else
                                            <button class="btn btn-outline-warning" disabled>Tidak Aktif</button>
                                        @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4" colspan="3">Tidak Ada data Yang ditemukan</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
</x-guest-card>
