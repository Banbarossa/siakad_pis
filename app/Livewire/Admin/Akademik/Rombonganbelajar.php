<?php

namespace App\Livewire\Admin\Akademik;

use App\Models\AnggotaRombel;
use App\Models\Guru;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Traits\SemesterAktif;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Rombonganbelajar extends Component
{
    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'tingkat_kelas', $sortDirection = 'asc';
    public $rombel_id, $nama_rombel, $tingkat_kelas, $sekolah_id, $absen_rombel_id, $guru_id;
    use SemesterAktif;
    public $tingkat_kelas_berdasarkan_sekolah = [];

    public function render()
    {

        $models = Rombel::with('sekolah', 'guru')->where('semester_id', $this->getAktifSemester()->id);

        if ($this->search) {
            $models = $models->where(function ($query) {
                $query->where('nama_rombel', 'like', "%" . $this->search . "%")
                    ->orWhere('tingkat_kelas', 'like', "%" . $this->search . "%")
                    ->orWhereHas('sekolah', function ($query) {
                        $query->where('nama_sekolah', 'like', "%" . $this->search . "%");
                    });
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

        $gurus = Guru::orderBy('nama_lengkap', 'asc')->get();

        return view('livewire.admin.akademik.rombonganbelajar', [
            'models' => $models,
            'sekolahs' => $sekolahs,
            'gurus' => $gurus,
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
        $this->sekolah_id = '';
        $this->absen_rombel_id = '';
        $this->guru_id = '';

    }

    public function updated($property)
    {
        if ($property === 'sekolah_id') {
            $sekolah = Sekolah::findOrFail($this->sekolah_id);
            if ($sekolah->tingkat == 'Ibtidaiyyah') {
                $this->tingkat_kelas_berdasarkan_sekolah = [1, 2, 3, 4, 5, 6];
            } elseif ($sekolah->tingkat == 'Mutawassithah') {
                $this->tingkat_kelas_berdasarkan_sekolah = [7, 8, 9];
            } else {
                $this->tingkat_kelas_berdasarkan_sekolah = [10, 11, 12];
            }
        }
    }

    public function rules()
    {
        return [
            'nama_rombel' => 'required',
            'sekolah_id' => 'required',
            'tingkat_kelas' => 'required',
            'guru_id' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'nama_rombel.required' => 'Nama Rombel Wajib Diisi',
            'sekolah_id.required' => 'Nama Sekolah Wajib dipilih',
            'tingkat_kelas.required' => 'Tingkat Kelas Wajib dipilih',
            'guru_id.required' => 'Wali kelas wajib dipilih',
        ];
    }

    public function store()
    {
        $cekUnique = Rombel::where('nama_rombel', $this->nama_rombel)->where('semester_id', $this->getAktifSemester()->id)->get();

        if ($cekUnique->count() == 0) {

            $this->validate();

            Rombel::create([
                'semester_id' => $this->getAktifSemester()->id,
                'nama_rombel' => $this->nama_rombel,
                'sekolah_id' => $this->sekolah_id,
                'tingkat_kelas' => $this->tingkat_kelas,
                'guru_id' => $this->guru_id,
            ]);

            $this->clear();
            $this->dispatch('close-modal');
            $this->alert('success', 'Data Berhasil Ditambahkan');
        } else {
            $this->alert('error', 'Gagal di input, data ganda');

        }

    }

    public function edit($id)
    {
        $rombel = rombel::findOrFail($id);
        $this->rombel_id = $rombel->id;
        $this->nama_rombel = $rombel->nama_rombel;
        $this->tingkat_kelas = $rombel->tingkat_kelas;
        $this->sekolah_id = $rombel->sekolah_id;
        $this->guru_id = $rombel->guru_id;
    }

    public function update()
    {

        $this->validate();

        Rombel::find($this->rombel_id)->update([
            'nama_rombel' => $this->nama_rombel,
            'sekolah_id' => $this->sekolah_id,
            'tingkat_kelas' => $this->tingkat_kelas,
            'guru_id' => $this->guru_id,
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
