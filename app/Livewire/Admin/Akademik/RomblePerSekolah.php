<?php

namespace App\Livewire\Admin\Akademik;

use App\Models\AnggotaRombel;
use App\Models\Pegawai;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Traits\SemesterAktif;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class RomblePerSekolah extends Component
{
    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'tingkat_kelas', $sortDirection = 'asc';
    public $rombel_id, $nama_rombel, $tingkat_kelas, $absen_rombel_id, $pegawai_id;

    public $tingkat_kelas_berdasarkan_sekolah;
    use SemesterAktif;

    public $sekolah_id, $sekolah;

    #[Title('Rombel')]
    public function mount($id)
    {
        $sekolah = Sekolah::find($id);
        $this->sekolah_id = $id;
        $this->sekolah = $sekolah;

        if ($sekolah->tingkat == 'Ibtidaiyyah') {
            $this->tingkat_kelas_berdasarkan_sekolah = [1, 2, 3, 4, 5, 6];
        } elseif ($sekolah->tingkat == 'Mutawassithah') {
            $this->tingkat_kelas_berdasarkan_sekolah = [7, 8, 9];
        } else {
            $this->tingkat_kelas_berdasarkan_sekolah = [10, 11, 12];
        }
    }
    public function render()
    {

        $models = Rombel::with('sekolah')->where('sekolah_id', $this->sekolah_id);

        if ($this->search) {
            $models = $models->where(function ($query) {
                $query->where('nama_rombel', 'like', "%" . $this->search . "%")
                    ->orWhere('tingkat_kelas', 'like', "%" . $this->search . "%");
            });
        }

        $models = $models->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        $semester = Semester::find(session()->get('semester_id'));
        $tahun_id = TahunAjaran::find($semester->tahun_ajaran_id);
        foreach ($models as $model) {
            $jumlah_anggota = AnggotaRombel::where('rombel_id', $model->id)->where('semester_id', $this->getAktifSemester()->id)->count();
            $model->jumlah_anggota = $jumlah_anggota;
        }

        $sekolahs = Sekolah::all();

        $pegawais = Pegawai::orderBy('nama', 'asc')->get();
        return view('livewire.admin.akademik.romble-per-sekolah', [
            'models' => $models,
            'sekolahs' => $sekolahs,
            'pegawais' => $pegawais,
        ]);
    }

    public function sortTable($column)
    {
        $this->sortColumn = $column;
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
    }

    public function clear()
    {
        $this->rombel_id = '';
        $this->nama_rombel = '';
        $this->tingkat_kelas = '';
        $this->absen_rombel_id = '';
        $this->pegawai_id = null;

    }
    public function store()
    {
        $this->validate([
            // 'absen_rombel_id' => 'required|unique:rombels,absen_rombel_id',
            // 'pegawai_id' => 'required|numeric',

            'nama_rombel' => 'required',
            'sekolah_id' => 'required',
            'tingkat_kelas' => 'required',
        ], [
            'nama_rombel.required' => 'Nama Rombel Wajib diisi',
            'tingkat_kelas.required' => 'Tingkat Kelas Wajib Dipilih',
        ]);

        Rombel::create([
            'semester_id' => $this->getAktifSemester()->id,
            'nama_rombel' => $this->nama_rombel,
            'sekolah_id' => $this->sekolah_id,
            'tingkat_kelas' => $this->tingkat_kelas,
            'absen_rombel_id' => $this->absen_rombel_id,
            'pegawai_id' => $this->pegawai_id,
        ]);

        $this->clear();
        $this->alert('success', 'Data Berhasil Ditambahkan');
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $rombel = rombel::findOrFail($id);
        $this->rombel_id = $rombel->id;
        $this->nama_rombel = $rombel->nama_rombel;
        $this->tingkat_kelas = $rombel->tingkat_kelas;
        $this->sekolah_id = $rombel->sekolah_id;
        $this->pegawai_id = $rombel->pegawai_id;
    }

    public function update()
    {

        $this->validate([
            'sekolah_id' => 'required',
            'nama_rombel' => 'required',
            'sekolah_id' => 'required',
            'tingkat_kelas' => 'required',
            // 'pegawai_id' => 'required',
        ], [
            'nama_rombel.required' => 'Nama Rombel Wajib Diisi',
            'sekolah_id.required' => 'Jenjang Sekolah Wajib dipilih',
            'tingkat_kelas.required' => 'Tingkat Kelas wajib dipilih',
        ]);

        Rombel::find($this->rombel_id)->update([
            'sekolah_id' => $this->sekolah_id,
            'nama_rombel' => 'required',
            'tingkat_kelas' => $this->tingkat_kelas,
            'nama_rombel' => $this->nama_rombel,
            'pegawai_id' => $this->pegawai_id,
        ]);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Ditambahkan');
    }

    public function destroy($id)
    {
        $jumlah_anggota = AnggotaRombel::where('rombel_id', $id)->where('semester_id', $this->getAktifSemester()->id)->count();
        $pesanError = 'Terdapat ' . $jumlah_anggota . ' siswa dirombel ini. Data Tidak Dapat Dihapus';

        if ($jumlah_anggota == 0) {
            Rombel::find($id)->delete();
            $this->alert('success', 'Data Berhasil dihapus');
        } else {
            $this->alert('error', $pesanError);
        }

    }
}
