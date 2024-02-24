<?php

namespace App\Livewire\Admin\Siswa;

use App\Models\Kafil;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SiswaYatim extends Component
{

    public $title = 'Data Santri Yatim';
    public $perPage = 25, $search;
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'nama', $sortDirection = 'asc';

    public $student_id;

    public $nama_kafil_indo, $nama_kafil_arab, $nomor_yatim, $nomor_kafil;

    public $kafil_id;

    #[Title('Data Santri Yatim')]
    public function render()
    {

        $students = Student::with(['guardians', 'kafil'])->where('status_siswa', 'aktif')
            ->where('status_sosial', 'like', 'yatim%')
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.admin.siswa.siswa-yatim', compact('students'));
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

    public function getStudentId($id)
    {
        $this->student_id = Student::findOrFail($id)->id;
    }

    public function clear()
    {
        $this->student_id = '';

        $this->kafil_id = '';
        $this->nama_kafil_indo = '';
        $this->nama_kafil_arab = '';
        $this->nomor_yatim = '';
        $this->nomor_kafil = '';
    }

    public function addKafil()
    {
        $this->validate([
            'nama_kafil_indo' => 'required',
            // 'nama_kafil_arab' => 'required',
            'nomor_yatim' => 'required',
            'nomor_kafil' => 'required',
        ], [
            'nama_kafil_indo.required' => 'Nama Kafil Dalam Bahasa Indonesia Wajib Di isi',
            // 'nama_kafil_arab.required' => 'nama Kafil Dalam Bahasa Arab Wajib Di isi',
            'nomor_yatim.required' => 'Nomor Yatim Dalam Bahasa Arab Wajib Di isi',
            'kafil.required' => 'Nomo Kafil Dalam Bahasa Arab Wajib Di isi',
        ]);

        Kafil::create([
            'student_id' => $this->student_id,
            'nama_kafil_indo' => $this->nama_kafil_indo,
            'nama_kafil_arab' => $this->nama_kafil_arab,
            'nomor_yatim' => $this->nomor_yatim,
            'nomor_kafil' => $this->nomor_kafil,
        ]);

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data kafil Berhasil ditambahkan');

    }

    public function editkafil($id)
    {

        $kafil = Kafil::findOrFail($id);
        $this->kafil_id = $kafil->id;
        $this->nama_kafil_indo = $kafil->nama_kafil_indo;
        $this->nama_kafil_arab = $kafil->nama_kafil_arab;
        $this->nomor_yatim = $kafil->nomor_yatim;
        $this->nomor_kafil = $kafil->nomor_kafil;
    }

    public function kafilUpdate()
    {

        Kafil::findOrFail($this->kafil_id)->update([
            'nama_kafil_indo' => $this->nama_kafil_indo,
            'nama_kafil_arab' => $this->nama_kafil_arab,
            'nomor_yatim' => $this->nomor_yatim,
            'nomor_kafil' => $this->nomor_kafil,
        ]);

        $this->clear();
        $this->alert('success', 'Data Berhasil di perbaharui');
        $this->dispatch('close-modal');

    }
}
