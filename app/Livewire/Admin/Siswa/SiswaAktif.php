<?php

namespace App\Livewire\Admin\Siswa;

use App\Exports\SantriActiveExport;
use App\Imports\SantriImport;
use App\Models\MutasiKeluar;
use App\Models\Student;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SiswaAktif extends Component
{

    public $title = 'Data Santri Aktif';
    public $perPage = 25, $search;
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'nama', $sortDirection = 'asc';

    public $registration_student_id, $registration_student_name, $sebab_keluar, $tanggal_mutasi, $alasan_pindah, $sekolah_lanjutan, $npsn;

    public $uploadSiswa;

    public $gagal = [];

    public $failures = [];

    #[Title('Data Santri Aktif')]
    public function render()
    {

        $students = Student::with('guardians')->SiswaAktif();

        if ($this->search) {
            $students = $students->where(function ($query) {
                $query->search($this->search);
            });
        }

        $students = $students->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.admin.siswa.siswa-aktif', compact('students'));
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

    public function exportExcel()
    {
        $filename = 'santri_aktif ' . date('Y-m-d H_i_s') . '.xls';
        return Excel::download(new SantriActiveExport, $filename);
    }
    public function showRegistration($id)
    {
        $student = Student::findOrFail($id);

        $this->registration_student_id = $student->id;
        $this->registration_student_name = $student->nama;
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

        $student = Student::findOrFail($this->registration_student_id);
        $student->update([
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

        $user = User::where('id', $student->user_id)->first();
        // $user->update([
        //     'is'
        // ])

        $userservice = new UserService();
        $userservice->updateUser($user->id);

        $this->clearRegistration();
        $this->alert('success', 'Proses Registrasi Siswa Berhasil');
        $this->dispatch('close-modal');

    }

    public function unduhTemplate()
    {

        $pathToFile = storage_path('/app/template/format-upload-santri.xlsx');
        $filename = 'template_santri ' . date('Y_m_d H_i_s') . '.xlsx';
        return response()->download($pathToFile, $filename);

    }

    public function getUploadSiswaFileName()
    {
        return $this->uploadSiswa->getClientOriginalName();
    }

    public function uploadData()
    {
        $this->validate([
            'uploadSiswa' => 'required|file|mimes:xlsx',
        ]);

        $path = $this->uploadSiswa->storeAs('excel_temp', $this->uploadSiswa->getClientOriginalName());

        // Excel::import(new SantriImport, storage_path('app/' . $path));
        $import = new SantriImport;
        $import->import($path);

        Storage::delete($path);

        if ($import->failures()) {
            session()->flash('failures', $import->failures());
            return redirect()->route('admin.siswa.aktif');
        } else {
            $this->dispatch('close-modal');
            $this->alert('success', 'Data Berhasil di Import');
        }

    }

}
