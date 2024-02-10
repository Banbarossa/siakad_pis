<?php

namespace App\Livewire\Admin\Pegawai;

use App\Models\Anakpegawai;
use App\Models\Istripegawai;
use App\Models\Pegawai;
use App\Traits\DaftarPekerjaan;
use App\Traits\OptionPendidikan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class ShowPegawaiDetail extends Component
{
    use OptionPendidikan, DaftarPekerjaan, LivewireAlert;
    public $pegawai_id;

    public $level = 1;

    // istri
    public $istri_id, $nama_istri, $nik_istri, $tempat_lahir_istri, $tanggal_lahir_istri, $pendidikan_istri, $pekerjaan_istri, $status_pasangan;

    // Anak
    public $anak_id, $nama_anak, $anak_ke, $nik_anak, $tempat_lahir_anak, $tanggal_lahir_anak, $jenis_kelamin_anak, $pendidikan_anak;

    public function mount($id)
    {
        $this->pegawai_id = $id;
    }

    #[Title('Detail pegawai')]
    public function render()
    {

        $pendidikan = $this->pendidikan();
        $daftar_pekerjaan = $this->pekerjaan();
        $pegawai = Pegawai::with(['istripegawai', 'anakpegawai' => function ($query) {
            $query->orderBy('anak_ke', 'asc');
        }])->find($this->pegawai_id);
        $pendidikan = $this->pendidikan();
        $daftar_pekerjaan = $this->pekerjaan();

        return view('livewire.admin.pegawai.show-pegawai-detail', compact('pegawai', 'pendidikan', 'daftar_pekerjaan'));
    }

    public function changeLevel($level)
    {
        $this->level = $level;
    }

    public function clearIstri()
    {
        $this->istri_id = '';
        $this->nama_istri = '';
        $this->nik_istri = '';
        $this->tempat_lahir_istri = '';
        $this->tanggal_lahir_istri = '';
        $this->pendidikan_istri = '';
        $this->pekerjaan_istri = '';

    }

    public function storeIstri()
    {
        $pegawai = Pegawai::whereId($this->pegawai_id)->pluck('jenis_kelamin')->first();

        if ($pegawai == 'laki laki') {
            $status = 'istri';
        } else {
            $status = 'suami';
        }

        $this->validate([
            'nama_istri' => 'required',
            'nik_istri' => 'required',
            'tempat_lahir_istri' => 'nullable',
            'tanggal_lahir_istri' => 'nullable',
            'pendidikan_istri' => 'nullable',
            'pekerjaan_istri' => 'nullable',
        ]);
        $pasangan = new Istripegawai();
        $pasangan->pegawai_id = $this->pegawai_id;
        $pasangan->status = $status;
        $pasangan->nama_istri = $this->nama_istri;
        $pasangan->nik_istri = $this->nik_istri;
        $pasangan->tempat_lahir_istri = $this->tempat_lahir_istri;
        $pasangan->tanggal_lahir_istri = $this->tanggal_lahir_istri;
        $pasangan->pendidikan_istri = $this->pendidikan_istri;
        $pasangan->pekerjaan_istri = $this->pekerjaan_istri;
        $pasangan->save();

        $this->dispatch('close-modal');
        $this->clearIstri();
        $this->alert('success', 'Data Berhasil Ditambahkan');
    }

    public function editIstri($id)
    {
        $istri = Istripegawai::find($id);
        $this->istri_id = $istri->id;
        $this->status_pasangan = $istri->status;
        $this->nama_istri = $istri->nama_istri;
        $this->nik_istri = $istri->nik_istri;
        $this->tempat_lahir_istri = $istri->tempat_lahir_istri;
        $this->tanggal_lahir_istri = $istri->tanggal_lahir_istri;
        $this->pendidikan_istri = $istri->pendidikan_istri;
        $this->pekerjaan_istri = $istri->pekerjaan_istri;
    }

    public function updateIstri()
    {
        $istri = Istripegawai::find($this->istri_id);
        $istri->nama_istri = $this->nama_istri;
        $istri->nik_istri = $this->nik_istri;
        $istri->tempat_lahir_istri = $this->tempat_lahir_istri;
        $istri->tanggal_lahir_istri = $this->tanggal_lahir_istri;
        $istri->pendidikan_istri = $this->pendidikan_istri;
        $istri->pekerjaan_istri = $this->pekerjaan_istri;
        $istri->save();
        $this->alert('success', 'Data Anak Berhasil diubah');
        $this->clearIstri();
        $this->dispatch('close-modal');
    }

    public function clearAnak()
    {
        $this->anak_id = '';
        $this->nama_anak = '';
        $this->anak_ke = '';
        $this->nik_anak = '';
        $this->tempat_lahir_anak = '';
        $this->tanggal_lahir_anak = '';
        $this->jenis_kelamin_anak = '';
        $this->pendidikan_anak = '';

    }

    public function storeAnak()
    {
        $this->validate([
            'nama_anak' => 'required',
            'anak_ke' => 'required|numeric',
            'nik_anak' => 'nullable|digits:16',
            'tempat_lahir_anak' => 'nullable',
            'tanggal_lahir_anak' => 'nullable',
            'jenis_kelamin_anak' => 'nullable',
            'pendidikan_anak' => 'nullable',
        ]);

        $anak = new Anakpegawai();
        $anak->pegawai_id = $this->pegawai_id;
        $anak->nama = $this->nama_anak;
        $anak->anak_ke = $this->anak_ke;
        $anak->nik = $this->nik_anak;
        $anak->tempat_lahir = $this->tempat_lahir_anak;
        $anak->tanggal_lahir = $this->tanggal_lahir_anak;
        $anak->jenis_kelamin = $this->jenis_kelamin_anak;
        $anak->pendidikan = $this->pendidikan_anak;
        $anak->save();

        $this->alert('success', 'Data Anak Berhasil ditambahkan');
        $this->clearAnak();
        $this->dispatch('close-modal');

    }

    public function editAnak($id)
    {
        $anak = Anakpegawai::find($id);
        $this->anak_id = $anak->id;
        $this->nama_anak = $anak->nama;
        $this->anak_ke = $anak->anak_ke;
        $this->nik_anak = $anak->nik;
        $this->tempat_lahir_anak = $anak->tempat_lahir;
        $this->tanggal_lahir_anak = $anak->tanggal_lahir;
        $this->jenis_kelamin_anak = $anak->jenis_kelamin;
        $this->pendidikan_anak = $anak->pendidikan;

    }

    public function updateAnak()
    {
        $anak = Anakpegawai::find($this->anak_id);
        $anak->nama = $this->nama_anak;
        $anak->anak_ke = $this->anak_ke;
        $anak->nik = $this->nik_anak;
        $anak->tempat_lahir = $this->tempat_lahir_anak;
        $anak->tanggal_lahir = $this->tanggal_lahir_anak;
        $anak->jenis_kelamin = $this->jenis_kelamin_anak;
        $anak->pendidikan = $this->pendidikan_anak;
        $anak->save();

        $this->alert('success', 'Data Anak Berhasil diubah');
        $this->clearAnak();
        $this->dispatch('close-modal');

    }

    public function destroyAnak($id)
    {
        Anakpegawai::find($id)->delete();
        $this->alert('success', 'Data Anak Berhasil diubah');
        $this->dispatch('close-modal');
    }

}
