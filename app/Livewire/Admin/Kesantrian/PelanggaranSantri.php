<?php

namespace App\Livewire\Admin\Kesantrian;

use App\Exports\PelanggaranExport;
use App\Models\Pelanggaran;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PelanggaranSantri extends Component
{

    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'tanggal', $sortDirection = 'desc';

    public $pelanggaran_id, $student_id, $tanggal, $jam, $level_pelanggaran, $deskripsi, $penanganan, $is_show = false, $point;

    public function render()
    {
        $pelanggaran = Pelanggaran::with('student');
        if ($this->sortColumn == 'nama') {
            $pelanggaran = Pelanggaran::with(['student' => function ($query) {
                $query->orderBy('nama', $this->sortDirection);
            }]);
        }
        if ($this->search) {
            $pelanggaran = $pelanggaran->where(function ($query) {
                $query->where('tanggal', 'like', "%" . $this->search . "%")
                    ->orWhereHas('student', function ($query) {
                        $query->where('nama', 'like', "%" . $this->search . "%");
                    });
            });
        }

        if ($this->sortColumn != 'nama') {
            $pelanggaran = $pelanggaran->orderBy($this->sortColumn, $this->sortDirection)->limit(300)->paginate($this->perPage);
        } else {
            $pelanggaran = $pelanggaran->limit(300)->paginate($this->perPage);
        }

        $students = Student::where('status_siswa', 'aktif')->orderBy('nama', 'asc')->get();

        return view('livewire.admin.kesantrian.pelanggaran-santri', [
            'pelanggaran' => $pelanggaran,
            'students' => $students,
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

    public function edit($id)
    {
        $pelanggaran = Pelanggaran::find($id);
        $this->pelanggaran_id = $id;
        $this->student_id = $pelanggaran->student_id;
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
        $this->alert('success', 'Data Berhasil Ditambahakan');
        $this->dispatch('close-modal');
    }

    public function clear()
    {
        $this->student_id = '';
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

    public function destroy($id)
    {
        Pelanggaran::findOrFail($id)->delete();
        $this->alert('success', 'Data Berhasil dihapus');
    }

    public function export()
    {
        $filename = 'daftar_pelanggaran_santri' . date('Y_m_d H_i_s') . '.xls';
        return Excel::download(new PelanggaranExport, $filename);
    }

}
