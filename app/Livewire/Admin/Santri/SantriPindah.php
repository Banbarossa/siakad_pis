<?php

namespace App\Livewire\Admin\Santri;

use App\Exports\SantriKeluar;
use App\Models\MutasiKeluar;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SantriPindah extends Component
{

    public $title = 'Data Santri Pindah';
    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'mutasi_keluars.tanggal_mutasi', $sortDirection = 'desc';

    public $registration_student_name, $sebab_keluar, $tanggal_mutasi, $alasan_pindah, $sekolah_lanjutan, $npsn;

    #[Title('Data Santri Lulus')]
    public function render()
    {

        $students = Student::join('mutasi_keluars', 'students.id', '=', 'mutasi_keluars.student_id')
            ->where('students.status_siswa', 'keluar')
            ->select('students.id', 'students.nama', 'students.nisn', 'students.nis_sekolah', 'students.nis_pesantren', 'mutasi_keluars.tanggal_mutasi');

        if ($this->search) {
            $students = $students->where(function ($query) {
                $query->search($this->search);
            });
        }

        $students = $students->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.admin.santri.santri-pindah', compact('students'));
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
        $this->registration_student_name = '';
        $this->sebab_keluar = '';
        $this->tanggal_mutasi = '';
        $this->alasan_pindah = '';
        $this->sekolah_lanjutan = '';
        $this->npsn = '';
    }

    public function showDetail($id)
    {
        $mutasi = MutasiKeluar::with('student')->where('student_id', $id)->first();
        $this->registration_student_name = $mutasi->student->nama;
        $this->sebab_keluar = $mutasi->sebab_keluar;
        $this->tanggal_mutasi = $mutasi->tanggal_mutasi;
        $this->alasan_pindah = $mutasi->alasan_pindah;
        $this->sekolah_lanjutan = $mutasi->sekolah_lanjutan;
        $this->npsn = $mutasi->npsn;
    }

    public function downloadExcel()
    {
        $filename = 'santri_keluar ' . date('y-m-d H_i_s') . '.xls';
        return Excel::download(new SantriKeluar, $filename);

    }
}
