<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Ajuan Surat</h1>
    @endslot

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
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
                        <table class="table table-sm table-head-fixed text-nowrap">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>Nama Santri</th>
                                    <x-th-sort label="Tanggal Ajuan" name="tanggal_pengajuan"
                                        sortColumn="{{ $sortColumn }}" sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Keperluan" name="keperluan" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Status</th>
                                </tr>

                            </thead>
                            <tbody>
                                @php
                                    $nomor = ($surat->currentPage() - 1) * $surat->perPage() + 1;
                                @endphp
                                @forelse($surat as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ ucFirst($item->nomor_surat) }}</td>
                                        <td>{{ ucFirst($item->nama) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="text-wrap">{{ $item->keperluan }}</td>
                                        <td>
                                            {{-- <button type="button" class="btn btn-sm btn-primary"
                                                wire:click='cetak({{ $item->id }})' data-toggle="modal"
                                                data-target="#modal-lg">
                                                Cetak
                                            </button> --}}

                                            <a href="{{ route('admin.cetak.surat-aktif.siswa',$item->id) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary">Cetak</a>
                                            <button wire:click='detail({{ $item->id }})' data-toggle="modal"
                                                data-target="#modal-detail"
                                                class="btn btn-sm btn-secondary">Detail</button>
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
                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex">
                                <div class="mr-4">
                                    <x-pagination-select></x-pagination-select>
                                </div>
                                <div>{{ $surat->links() }}</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>

    {{-- <div class="modal fade show" id="modal-lg" aria-modal="false" role="dialog" wire:ignore.self>
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

    </div> --}}

    {{-- Show Detail --}}
    <div class="modal fade show" id="modal-detail" aria-modal="false" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-default modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cetak Surat</h4>
                    <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @if($detailSurat)
                    <div class="modal-body">
                        <table>
                            <tbody>

                                <tr>
                                    <td>Nama Santri</td>
                                    <td class="pl-3">:</td>
                                    <th class="pl-3">
                                        {{ $detailSurat->nomor_surat }}
                                    </th>
                                </tr>
                                <tr>
                                    <td>Nama Santri</td>
                                    <td class="pl-3">:</td>
                                    <th class="pl-3">
                                        {{ $detailSurat->nama }}
                                    </th>
                                </tr>
                                <tr>
                                    <td>NIS-P/NISN</td>
                                    <td class="pl-3">:</td>
                                    <th class="pl-3">
                                        {{ $detailSurat->nisp_nisn }}
                                    </th>
                                </tr>

                                <tr>
                                    <td>Keperluan</td>
                                    <td class="pl-3">:</td>
                                    <th class="pl-3">{{ $detailSurat->keperluan }}</th>
                                </tr>
                                <tr>
                                    <td>Tanggal Pengajuan</td>
                                    <td class="pl-3">:</td>
                                    <th class="pl-3">{{ \Carbon\Carbon::parse($detailSurat->created_at)->format('d F Y') }}</th>
                                </tr>
                                <tr>
                                    <td>Keperluan</td>
                                    <td class="pl-3">:</td>
                                    <th class="pl-3"
                                        style="white-space: normal; overflow: hidden; text-overflow: ellipsis; max-width: 300px;">
                                        {{ $detailSurat->keperluan }}</th>
                                </tr>
                            </tbody>
                        </table>


                    </div>


                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" wire:click='clear'
                            data-dismiss="modal">Close</button>
                    </div>
                @endif
            </div>

        </div>

    </div>

</div>
