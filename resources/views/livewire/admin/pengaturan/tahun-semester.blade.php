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
                                    <x-th-sort label="Semester" name="semester" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Tahun Ajaran</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Status</th>
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
                                        <td>{{ $item->semester }}</td>
                                        <td>{{ $item->tahunAjaran ? $item->tahunAjaran->tahun :'' }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>
                                            @if (!$item->status)
                                                <button class="btn btn-sm btn-outline-danger" wire:confirm='Apakah Anda mengaktifkan Semester?'  wire:click='updateStatus({{$item->id}})'><i class="fas fa-check mr-2"></i>Aktifkan</button>
                                            @else
                                            <button class="btn btn-sm btn-outline-success" ><i class="fas fa-check mr-2"></i>Aktif</button>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default" wire:click='edit({{$item->id}})'><i class="fas fa-edit mr-2"></i>Edit</button>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Tidak Ada Data Semester</td>
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




        @include('livewire.admin.pengaturan.part.form-add-semester')
        @include('livewire.admin.pengaturan.part.form-add-tahun')
    </div>


    
</div>
