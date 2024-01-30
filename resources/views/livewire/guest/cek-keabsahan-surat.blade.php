<div>
    <section class="mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Hasil Pencarian</h3>
                    </div>
                    <div class="card-body table-responsive px-3" style="height: 300px;">
                        <table class="table table-sm table-striped">
							<thead>
								<tr>
									<td>Nomor Surat</td>
									<td>Jenis Surat</td>
									<td>Pemilik Surat</td>
									<td>Tanggal Surat</td>
								</tr>
							</thead>
							<tbody>
								@if ($surat)
								<tr>
									<td>{{$surat->nomor_surat}}</td>
									<td>{{$surat->jenis_surat}}</td>
									<td>{{$surat->student->nama}}</td>
									<td>{{$surat->tanggal_disetujui}}</td>

								</tr>
								@else
								<tr>
									<td colspan="4">Surat Tidak ditemukan</td>
								</tr>
								@endif
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
