<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Rekap Catatan Kesantrian</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" wire:model.live.debounce.100ms="search" class="float-right form-control"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-head-fixed text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <x-th-sort label="Nama" name="nama" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>NISN</th>
                                    <th>Jumlah Prestasi</th>
                                    <th>Jumlah Beasiswa</th>
                                    <th>Jumlah Pelanggaran</th>
                                    <th>Point Pelanggaran</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($students->currentPage() - 1) * $students->perPage() + 1;
                                @endphp

                                @forelse($students as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td><a href="{{route('admin.kesantrian.detail.prestasi',$item->id)}}" class="btn btn-sm btn-primary"><i class="mr-3 fas fa-trophy"></i>{{ $item->jumlahPrestasi}}</a></td>
                                        <td><a href="{{route('admin.kesantrian.detail.beasiswa',$item->id)}}" class="btn btn-sm btn-success"><i class="mr-3 fas fa-money-bill"></i>{{ $item->jumlahBeasiswa}}</a></td>
                                        <td><a href="{{route('admin.kesantrian.detail.pelanggaran',$item->id)}}" class="btn btn-sm btn-danger"><i class="mr-3 fas fa-ban"></i>{{ $item->jumlahPelanggaran}}</a></td>
                                        <td>{{$item->jumlahPoint .' Poin' }}</td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak Ada Data</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="card-tools">
                        <div class="d-flex">
                            <div class="mr-4">
                                <x-pagination-select></x-pagination-select>
                            </div>
                            <div>{{ $students->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    
</div>
