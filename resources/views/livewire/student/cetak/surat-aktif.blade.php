<main>
    <x-student-welcome>
        <div class="text-center">
            @if ($surat->count()>0)
            Anda memiliki {{ $surat->count() }} surat aktif yang diajukan
            @else
            Anda Belum Pernah Mengajukan Surat Aktif Belajar
           
            @endif
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block px-4 py-2 mx-auto mt-2 border-2 border-red-200 rounded-full bg-gradient-to-r from-red-900 via-red-400 to-red-700 text-gray-50 hover:ring-2 hover:ring-red-200 " type="button">
                Buat Surat baru
            </button>
            
        </div>
    </x-student-welcome>

    @if ($surat->count()>0)
        
    <div class="w-full mt-6">
        <div class="p-8 bg-white rounded-lg dark:bg-gray-800">
            
            <ol class="relative border-gray-200 border-s dark:border-gray-700">
                @forelse ($surat as $item)
                <li class="mb-10 ms-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                    <time class="flex justify-between mb-1 text-sm font-normal leading-none text-gray-400 align-middle dark:text-gray-500">
                        <span>
                            {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->format ('d F Y H:i:s') }}
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->diffForHumans() }}
                        </span>
                    </time>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item->jenis_surat }} <span class="text-xs text-gray-900 dark:text-white">No: {{ $item->nomor_surat }}</span></h3>
                    {{-- <h3 class="text-xs text-gray-900 dark:text-white">No: {{ $item->nomor_surat }}</h3> --}}
                    <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ ucWords($item->keperluan) }}</p>
                    <a href="{{ route('student.generate.surat-aktif',$item->id) }}" target="blank"  class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Cetak Surat
                        <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </li>
                @empty
                <li class="mb-10 ms-4">
                    <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Belum Ada surat yang pernah diajukan</p>
                </li>
                @endforelse                  
                
            </ol>

            <div class="mt-3">{{ $surat->links() }}</div>
    
    
        </div>
    </div>
    @endif

    {{-- Modal --}}

    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" wire:ignore.self>
        <div class="relative w-full max-w-md max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Buat Surat Baru
                    </h3>
                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" wire:submit='store'>
                    <div class="col-span-2 mb-6">
                        <x-input-label for="keperluan" class="mb-2">{{ __('Keperluan') }}</x-input-label>
                        <x-tail-text-input class="w-full" wire:model.live='keperluan' type="text" placeholder="Keperluan" id="keperluan"></x-tail-text-input>
                        <x-input-error :messages="$errors->get('keperluan')"></x-input-error>
                    </div>

                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Ajukan Baru
                    </button>
                </form>
            </div>
        </div>
    </div> 

</main>












{{-- <div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Pengajuan Surat Aktif</h1>
    @endslot


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Ajukan Surat
                        </button>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" wire:model.live.debounce.150ms='search'
                                    class="float-right form-control" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-3 card-body table-responsive">
                        <table class="table table-head-fixed text-nowrap">

                            <thead>
                                <tr>
                                    <th>Nama Santri</th>
                                    <th>Jenis Surat</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Diajukan Oleh</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                </tr>

                            </thead>
                            <tbody>
                                @forelse($surat as $item)
                                    <tr>
                                        <td>{{ ucFirst($item->student->nama) }}</td>
                                        <td>{{ ucFirst($item->jenis_surat) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d/M/Y') }}
                                        </td>
                                        <td>{{ $item->pengajusurat ? $item->pengajusurat->name : '' }}</td>
                                        <td>{{ $item->keperluan }}</td>
                                        <td>
                                            @if($item->tanggal_disetujui)
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    wire:click='cetak({{ $item->id }})' data-toggle="modal"
                                                    data-target="#modal-lg">
                                                    Cetak
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-warning">Belum disetujui</button>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="">Data Tidak ditemukan</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>


    </div>

    <div class="modal fade show" id="modal-lg" aria-modal="false" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cetak Surat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @if($pengajuan)
                    <div class="modal-body">
                        <div class="surat" id="pdf">
                            <div class="px-5 pt-2">
                                <div class="mb-3 text-center form-group" style="padding: 0px 6px;">
                                    <img src="{{ asset('images/kop.jpg') }}" alt="kop"
                                        style="width: 100%">
                                </div>
                                <div class="mb-5 text-center form-group">
                                    <h5 class="font-weight-bold" style="text-decoration:underline;">SURAT AKTIF BELAJAR
                                        </h4>
                                        <H5>{{ $pengajuan->nomor_surat }}</H5>
                                </div>
                                <div class="form-group">
                                    <p style="text-align: justify">
                                        Pimpinan Pesantren Imam Syafi'i Kecamatan Sukamakmur Kabupaten Aceh Besar dengan
                                        ini menerangkan bahwa:
                                    </p>
                                </div>
                                <div class="mt-3 form-group">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="pr-3">Nama</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3">{{ UcFirst($pengajuan->student->nama) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-3">Tempat, Tgl Lahir</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3">{{ UcFirst($pengajuan->student->tempat_lahir) }},
                                                    {{ \Carbon\Carbon::parse($pengajuan->student->tanggal_lahir)->formatLocalized('%d %B %Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-3">NISP/NISN</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3">{{ $pengajuan->student->nis_pesantren }} /
                                                    {{ $pengajuan->student->nisn }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-3">Jenis Kelamin</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3">{{ $pengajuan->student->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-3">Kelas</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3"></td>
                                            </tr>
                                            <tr>
                                                <td class="pr-3">Alamat</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3"></td>
                                            </tr>
                                            <tr>
                                                <td class="pr-3">Anak Dari</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3"></td>
                                            </tr>
                                            <tr>
                                                <td class="pr-3">Nama</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3">{{ UcFirst($pengajuan->student->ayah_nama) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-3">Pekerjaan</td>
                                                <td class="pr-3">:</td>
                                                <td class="pr-3">{{ UcFirst($pengajuan->student->ayah_pekerjaan) }}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 form-group">
                                    <p style="text-align: justify">
                                        Dengan ini menyatakan bahwan nama yang tersebut diatas benar masih aktif sebagai
                                        santri di Pesantren Imam Syafi'i Sibreh - Aceh Besar Tahun Pelajaran 2023/2024.
                                    </p>
                                    <p style="text-align: justify">
                                        Demikian surat keterangan ini dinuat unutk dipergunakan sebagaimana mestinya.
                                        <span class="font-italic">jazaakumullahukhairan</span>
                                    </p>
                                </div>
                                <div class="mt-5 d-flex justify-content-between">
                                    <div class="text-center visible-print">
                                        {!! QrCode::size(70)->generate(url('/ceksurat/' . $pengajuan->kode_surat)); !!}


                                        <div>
                                            {{ Request::routeIs('cek.surat'),'dhakhdka' }}
                                        </div>
                                        <div>
                                            <small class="text-muted">Cek Keabsahan Surat</small>
                                        </div>
                                    </div>
                                    <div class="text-center signature">
                                        <div>
                                            Sibreh,
                                            {{ \Carbon\Carbon::parse($pengajuan->tanggal_disetujui)->formatLocalized('%d %B %Y') }}
                                        </div>
                                        <div style="margin-bottom: 70px">Pimpinan Pesantren</div>
                                        <div class="font-weight-bold">[Nama dan Tanda Tangan]</div>
                                        <div class="font-weight-bold">[NUPL]</div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="generatePdf()">Cetak</button>
                </div>
            </div>

        </div>

    </div>


    <div class="modal fade" id="modal-default" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='addData'>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Santri</label>
                            <select class="form-control @error('siswa_id') is-invalid @enderror"
                                wire:model.live='siswa_id'>
                                <option>Pilih Siswa</option>
                                @foreach($siswa as $item)
                                    <option value="{{ $item->id }}">{{ ucFirst($item->nama) }}</option>
                                @endforeach
                            </select>
                            @error('siswa_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Surat</label>
                            <select class="form-control @error('jenis_surat') is-invalid @enderror"
                                wire:model.live='jenis_surat'>
                                <option>Jenis Surat Jang Diajukan</option>
                                @foreach($typeSurat as $item)
                                    <option value="{{ $item }}">{{ ucFirst($item) }}</option>
                                @endforeach
                            </select>
                            @error('jenis_surat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keperluaan">Keperluan</label>
                            <textarea class="form-control @error('keperluan') is-invalid @enderror" rows="3"
                                placeholder="Tuliskan Keperluan surat" wire:model.live='keperluan'></textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

        @push('mystyle')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
                integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                function generatePdf() {

                    const element = document.getElementById('pdf');
                    var opt = {
                        margin: 0,
                        filename: 'Surat Aktif Belajar.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2
                        },
                        jsPDF: {
                            unit: 'mm',
                            format: [210, 330],
                            orientation: 'portrait'
                        }
                    };

                    html2pdf().set(opt).from(element).save();
                }

            </script>

            <script>
                window.addEventListener('close-modal', event => {
                    $('#crudModal').modal('hide');
                })

            </script>

        @endpush

    </div>
</div> --}}
