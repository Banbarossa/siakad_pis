<?php

namespace App\Livewire\Admin\Kesantrian;

use App\Models\Pelanggaran;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class DetailPelanggaran extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search, $perPage = 15, $sortColumn = 'tanggal', $sortDirection = 'desc';
    public $student_nama;
    public $pelanggaran_id, $student_id, $tanggal, $jam, $level_pelanggaran, $deskripsi, $penanganan, $is_show = false, $point;

    public function mount($id)
    {
        $student = Student::where('status_siswa', 'aktif')->where('id', $id)->first();

        $this->student_id = $student->id;
        $this->student_nama = $student->nama;

    }

    #[Title('Detail pelanggaran')]
    public function render()
    {
        $pelanggaran = Pelanggaran::where('student_id', $this->student_id)
            ->when($this->search, function ($query) {
                $query->where('tanggal', 'like', '%' . $this->search . '%')
                    ->orWhere('level_pelanggaran', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
                    ->orWhere('penanganan', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.admin.kesantrian.detail-pelanggaran', compact('pelanggaran'));
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
    public function store()
    {

        $validation = $this->validate([
            'student_id' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'level_pelanggaran' => 'required',
            'deskripsi' => 'required',
            'penanganan' => 'nullable',
            'is_show' => 'required',
            'point' => 'required',
        ]);

        Pelanggaran::create($validation);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Ditambahakan');
    }

    public function clear()
    {
        $this->tanggal = '';
        $this->jam = '';
        $this->level_pelanggaran = '';
        $this->deskripsi = '';
        $this->penanganan = '';
        $this->is_show = '';
        $this->point = '';
    }

    public function updateShow($id)
    {
        $pelanggaran = Pelanggaran::find($id);
        $pelanggaran->is_show = !$pelanggaran->is_show;
        $pelanggaran->save();
        $this->alert('success', 'Data berhasil diupdate');
    }

    public function edit($id)
    {
        $pelanggaran = Pelanggaran::find($id);
        $this->pelanggaran_id = $id;
        $this->tanggal = $pelanggaran->tanggal;
        $this->jam = $pelanggaran->jam;
        $this->level_pelanggaran = $pelanggaran->level_pelanggaran;
        $this->deskripsi = $pelanggaran->deskripsi;
        $this->penanganan = $pelanggaran->penanganan;
        $this->point = $pelanggaran->point;
        if ($pelanggaran->is_show == 1) {
            $this->is_show = true;
        }

    }
    public function update()
    {
        $validation = $this->validate([
            'student_id' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'level_pelanggaran' => 'required',
            'deskripsi' => 'required',
            'penanganan' => 'nullable',
            'is_show' => 'required',
            'point' => 'required',
        ]);
        Pelanggaran::find($this->pelanggaran_id)->update($validation);

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Ditambahakan');
    }

    public function destroy($id)
    {
        Pelanggaran::find($id)->delete();
        $this->alert('success', 'Data Berhasil Ditambahakan');

    }

}
