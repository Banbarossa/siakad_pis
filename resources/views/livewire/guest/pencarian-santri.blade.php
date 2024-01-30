<div>
    <section id="content" class="mt-5">
        <div class="container-fluid">
            <h2 class="text-center display-">Search</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <input type="search" wire:model.live='search' class="form-control form-control" placeholder="Masukkan Nama Atau NISN">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="mt-5">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hasil Pencarian</h3>
                </div>
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tahun Masuk</th>
                            <th>Aktif</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($student as $item)
                        <tr>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->tahun_masuk}}</td>
                            <td>
                                @if ($item->is_aktif)
                                    <button class="btn btn-outline-success" disabled>Aktif</button>
                                @else
                                    <button class="btn btn-outline-warning" disabled>Tidak Aktif</button>
                                @endif
                                {{-- {{$item->is_aktif}} --}}
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak Ada data Yang ditemukan</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </section>

</div>
