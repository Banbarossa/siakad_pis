<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Semester</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">

                        <button type="button" class="btn btn-tool btn-sm ml-2" data-toggle="modal" data-target='#modal-default'>
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <span>
                        <x-search-default/>
                    </span>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-head-fixed text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <x-th-sort label="Nama Sekolah" name="nama_sekolah" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tingkat" name="tingkat" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Jumlah Rombel</th>
                                    <th>Kepala Sekolah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($models->currentPage() - 1) * $models->perPage() + 1;
                                @endphp

                                @forelse($models as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->nama_sekolah }}</td>
                                        <td>{{ $item->tingkat }}</td>
                                        <td>
                                            <a href="{{route('admin.master.rombel.sekolah',$item->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-list mr-2"></i>{{$item->jumlah_rombel}}</a>
                                        </td>
                                        <td>{{ $item->user ? $item->user->name:'' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default" wire:click='edit({{$item->id}})'><i class="fas fa-edit mr-2"></i>Edit</button>
                                        </td>


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
                            <div>{{ $models->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        @include('livewire.admin.akademik.part.add-sekolah')
    </div>


    
</div>
