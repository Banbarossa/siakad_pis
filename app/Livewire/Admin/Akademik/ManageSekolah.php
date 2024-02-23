<?php

namespace App\Livewire\Admin\Akademik;

use App\Models\Pegawai;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Traits\SemesterAktif;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ManageSekolah extends Component
{

    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'nama_sekolah', $sortDirection = 'desc';
    public $sekolah_id, $nama_sekolah, $tingkat, $pegawai_id;
    use SemesterAktif;

    public function render()
    {

        $models = Sekolah::with('pegawai');

        if ($this->search) {
            $models = $models->where(function ($query) {
                $query->where('nama_sekolah', 'like', "%" . $this->search . "%")
                    ->orWhere('tingkat', 'like', "%" . $this->search . "%")
                    ->orWhereHas('pegawai', function ($query) {
                        $query->where('name', 'like', "%" . $this->search . "%");
                    });
            });
        }

        $models = $models->orderBy($this->sortColumn, $this->sortDirection)->limit(500)->paginate($this->perPage);

        foreach ($models as $item) {
            $jumlah_rombel = Rombel::where('semester_id', $this->getAktifSemester()->id)
                ->where('sekolah_id', $item->id)
                ->count();
            $item->jumlah_rombel = $jumlah_rombel;
        };

        $pegawais = Pegawai::orderBy('nama', 'asc')->get();
        return view('livewire.admin.akademik.manage-sekolah', [
            'models' => $models,
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
        $this->sekolah_id = '';
        $this->nama_sekolah = '';
        $this->tingkat = '';
        $this->pegawai_id = null;
    }

    public function store()
    {
        $validator = $this->validate([
            'nama_sekolah' => 'required|unique:sekolahs,nama_sekolah',
            'tingkat' => 'required',
            // 'pegawai_id' => 'required',
        ]);

        Sekolah::create($validator);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $this->sekolah_id = $sekolah->id;
        $this->nama_sekolah = $sekolah->nama_sekolah;
        $this->tingkat = $sekolah->tingkat;
        $this->pegawai_id = $sekolah->pegawai_id;
    }

    public function update()
    {
        $validator = $this->validate([
            'nama_sekolah' => 'required',
            'tingkat' => 'required',
            // 'pegawai_id' => 'required',
        ]);
        $sekolah = sekolah::find($this->sekolah_id);
        $sekolah->update($validator);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Diubah');
    }

}
