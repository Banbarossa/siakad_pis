<div class="content">
  @slot('title')
      <h1 class="font-weight-bold">Beasiswa</h1>
  @endslot


  <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Beasiswa</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" wire:model.live.debounce.150ms="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive px-3">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Nama Santri</th>
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Tanggal Terima</th>
                      <th>Sumber</th>
                      <th>Jumlah</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                      @forelse ($beasiswa as $item)
                      <tr>
                          <td>{{$item->student ? $item->student->nama : ''}}</td>
                          <td>{{$item->tahun}}</td>
                          <td>{{$item->bulan}}</td>
                          <td>{{$item->tanggal_terima}}</td>
                          <td>{{$item->sumber}}</td>
                          <td>{{ 'Rp ' . number_format($item->jumlah, 0, ',', '.') }}</td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="5">Belum ditemukan data beasiswa yang tercatat</td>
                      </tr>
                      @endforelse

                     
                  </tbody>
                </table>

                {{$beasiswa->links()}}
              </div>
              
            </div>
            
          </div>
        </div>

      
  </div>

</div>
