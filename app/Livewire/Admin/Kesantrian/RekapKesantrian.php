<?php

namespace App\Livewire\Admin\Kesantrian;

use App\Models\Pelanggaran;
use App\Models\Prestasi;
use App\Models\Scholarship;
use App\Models\Student;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class RekapKesantrian extends Component
{
    public $title = 'Rekap Kesantrian';
    use WithPagination;

    public $perPage = 15, $search;
    public $sortColumn = 'nama', $sortDirection = 'asc';

    #[Title('Rekap Kesantrian')]
    public function render()
    {

        $students = Student::SiswaAktif();

        if ($this->search) {
            $students = $students->where('nama', 'like', '%' . $this->search . '%');
        };

        $students = $students->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        foreach ($students as $student) {
            $jumlahPrestasi = Prestasi::where('student_id', $student->id)->count();
            $student->jumlahPrestasi = $jumlahPrestasi;

            $beasiswa = Scholarship::where('student_id', $student->id)->count();
            $student->jumlahBeasiswa = $beasiswa;

            $pelanggaran = Pelanggaran::where('student_id', $student->id)->get();
            $jumlah_pelanggaran = $pelanggaran->count();
            $jumlah_poin = $pelanggaran->sum('point');
            $student->jumlahPelanggaran = $jumlah_pelanggaran;
            $student->jumlahPoint = $jumlah_poin;
        }
        return view('livewire.admin.kesantrian.rekap-kesantrian', compact('students'));
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
}
