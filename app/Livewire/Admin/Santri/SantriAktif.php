<?php

namespace App\Livewire\Admin\Santri;

use App\Exports\ActiveStudentImport;
use App\Imports\SantriImport;
use App\Models\MutasiKeluar;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SantriAktif extends Component
{

    public $title = 'Data Santri Aktif';

    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'nama', $sortDirection = 'asc';

    public $registration_student_id, $registration_student_name, $sebab_keluar, $tanggal_mutasi, $alasan_pindah, $sekolah_lanjutan, $npsn;

    public $uploadSiswa;

    public function mount()
    {
        $this->tanggal_mutasi = Carbon::now()->toDateString();
    }

    #[Title('Data Santri Aktif')]
    public function render()
    {

        $students = Student::SiswaAktif();

        if ($this->search) {
            $students = $students->where(function ($query) {
                $query->search($this->search);
            });
        }

        $students = $students->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.admin.santri.__santri-aktif', ['students' => $students]);
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

    public function unduhTemplate()
    {

        $pathToFile = storage_path('/app/template/add-siswa-template.xlsx');

        return response()->download($pathToFile);

    }

    public function uploadData()
    {
        $this->validate([
            'uploadSiswa' => 'required|file|mimes:xlsx',
        ]);

        $path = $this->uploadSiswa->storeAs('excel_temp', $this->uploadSiswa->getClientOriginalName());

        Excel::import(new SantriImport, storage_path('app/' . $path));

        Storage::delete($path);

        $this->alert('success', 'Data Berhasil di Import');

    }

    public function unduhSantriAktif()
    {
        return Excel::download(new ActiveStudentImport, 'siswa_aktif.xlsx');
    }

    public function showRegistration($id)
    {
        $student = Student::findOrFail($id);

        $this->registration_student_id = $student->id;
        $this->registration_student_name = $student->nama;
    }

    public function storeRegistration()
    {

        $this->validate([
            'sebab_keluar' => 'required',
            'tanggal_mutasi' => 'required|date',
            'alasan_pindah' => 'required',
        ], [
            'sebab_keluar.required' => 'Alasan Keluar Wajib Diisi',
            'tanggal_mutasi.required' => 'Tanggal Keluar Wajib Diisi',
            'tanggal_mutasi.date' => 'Tanggal harus dalam format tanggal ',
            'alasan_pindah.required' => 'Alasan Pindah Wajib Di isi',
        ]);

        Student::findOrFail($this->registration_student_id)->update([
            'status_siswa' => 'keluar',
        ]);

        MutasiKeluar::create([
            'student_id' => $this->registration_student_id,
            'sebab_keluar' => $this->sebab_keluar,
            'tanggal_mutasi' => $this->tanggal_mutasi,
            'alasan_pindah' => $this->alasan_pindah,
            'sekolah_lanjutan' => $this->sekolah_lanjutan,
            'npsn' => $this->npsn,
        ]);
        $this->clearRegistration();
        $this->alert('success', 'Proses Registrasi Siswa Berhasil');
        $this->dispatch('close-modal');

    }

    public function clearRegistration()
    {
        $this->registration_student_id = '';
        $this->registration_student_name = '';
        $this->sebab_keluar = '';
        $this->tanggal_mutasi = '';
        $this->alasan_pindah = '';
        $this->sekolah_lanjutan = '';
        $this->npsn = '';

    }

}
