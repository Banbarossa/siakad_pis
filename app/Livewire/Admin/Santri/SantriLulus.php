<?php

namespace App\Livewire\Admin\Santri;

use App\Exports\LulusanExport;
use App\Models\Alumni;
use App\Models\AnggotaRombel;
use App\Models\Student;
use App\Services\UserService;
use App\Traits\SemesterAktif;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SantriLulus extends Component
{

    public $title = 'Data Santri Lulus';
    public $form_level = 1;
    public $perPage = 25, $search;
    use LivewireAlert;
    use WithPagination;
    public $sortColumn = 'nama', $sortDirection = 'asc', $selectedStudent = [];

    public $tanggal_lulus, $lanjutan_pendidikan, $contact;
    use SemesterAktif;

    #[Title('Data Santri Lulus')]
    public function render()
    {

        $students = Alumni::with('student')
            ->when($this->search, function ($query) {
                $query->whereHas('student', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%');
                });
            })->orderBy('created_at', 'desc')->paginate($this->perPage);


        $students_kelas_akhir = AnggotaRombel::with('student', 'rombel')
            ->where('semester_id', $this->getAktifSemester()->id)
            ->whereHas('student', function ($query) {
                $query->whereDoesntHave('alumni');
            })
            ->whereHas('rombel', function ($query) {
                $query->where('tingkat_kelas', 12);
            })
            ->get();

        return view('livewire.admin.santri.santri-lulus', compact('students', 'students_kelas_akhir'));
    }

    public function updateLevel()
    {
        $this->form_level = 2;
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
        $this->selectedStudent = [];
        $this->tanggal_lulus = '';
        $this->lanjutan_pendidikan = '';
        $this->contact = '';
    }

    public function download()
    {
        $filename = 'data_alumni ' . date('y-m-d H_i_s') . '.xls';

        return Excel::download(new LulusanExport, $filename);

    }

    public function luluskan()
    {
        $this->validate([
            'tanggal_lulus' => 'required|date',
            'lanjutan_pendidikan' => 'required',
            'contact' => 'nullable',
        ]);

        $anggota_rombel = AnggotaRombel::whereIn('id', $this->selectedStudent)->get();

        foreach ($anggota_rombel as $anggota) {
            $student = Student::findOrFail($anggota->student_id);
            $student->update([
                'status_siswa' => 'lulus',
            ]);
            \App\Models\Alumni::create([
                'student_id' => $anggota->student_id,
                'tanggal_lulus' => $this->tanggal_lulus,
                'lanjutan_pendidikan' => $this->lanjutan_pendidikan,
                'contact' => $this->contact,
            ]);

            $nonaktifkanakun = new UserService();
            $nonaktifkanakun->updateUser($student->user_id);
        }
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'data Berhasil diluluskan');
    }

}
