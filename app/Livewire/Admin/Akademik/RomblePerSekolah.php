<?php

namespace App\Livewire\Admin\Akademik;

use App\Models\AnggotaRombel;
use App\Models\Guru;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Traits\SemesterAktif;
use GuzzleHttp\Client;
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
    public $rombel_id, $nama_rombel, $tingkat_kelas, $absen_rombel_id, $guru_id;
    use SemesterAktif;

    public $sekolah_id, $sekolah;

    #[Title('Rombel')]
    public function mount($id)
    {
        $this->sekolah_id = $id;
        $this->sekolah = Sekolah::find($id);
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

        $client = new Client();
        $request = $client->get('https://absen.pis.sch.id/api/rombel');
        $response = $request->getBody()->getContents();
        $rombelArray = json_decode($response, true);
        $rombel = $rombelArray['data'];

        $gurus = Guru::orderBy('nama_lengkap', 'asc')->get();
        return view('livewire.admin.akademik.romble-per-sekolah', [
            'models' => $models,
            'sekolahs' => $sekolahs,
            'rombels' => $rombel,
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
        $this->absen_rombel_id = '';
        $this->guru_id = '';

    }
    public function store()
    {
        $validator = $this->validate([
            'absen_rombel_id' => 'required|unique:rombels,absen_rombel_id',
            'guru_id' => 'required|numeric',
        ]);

        $client = new Client();
        $request = $client->get('https://absen.pis.sch.id/api/rombel/' . $this->absen_rombel_id);
        $response = $request->getBody()->getContents();
        $rombelArray = json_decode($response, true);

        $rombel = $rombelArray['data'];

        Rombel::create([
            'semester_id' => $this->getAktifSemester()->id,
            'nama_rombel' => $rombel['nama_rombel'],
            'sekolah_id' => $this->sekolah_id,
            'tingkat_kelas' => $rombel['tingkat_kelas'],
            'absen_rombel_id' => $this->absen_rombel_id,
            'guru_id' => $this->guru_id,
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
        $this->guru_id = $rombel->guru_id;
    }

    public function update()
    {

        $validator = $this->validate([
            'sekolah_id' => 'required',
            'guru_id' => 'required',
        ]);

        Rombel::find($this->rombel_id)->update([
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
