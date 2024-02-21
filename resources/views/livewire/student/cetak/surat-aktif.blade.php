<div class="content">


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
            <div class="flex justify-center">
                <a href="{{ route('student.cetak.surat-aktif') }}" wire:navigate class="px-4 py-2 border-2 border-red-200 rounded-full bg-gradient-to-r from-red-900 via-red-400 to-red-700 text-gray-50">Surat Aktif Belajar</a>

            </div>
        <span class="sr-only">Loading...</span>
        </div>
    </div>


</div>










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
