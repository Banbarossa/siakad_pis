<?php

namespace App\Livewire\Admin\Kesantrian;

use App\Models\Prestasi;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class DetailPrestasi extends Component
{
    public $title = 'Detail Prestasi';
    public $perPage = 15, $search;
    public $sortColumn = 'tanggal', $sortDirection = 'desc';
    use WithPagination;
    use LivewireAlert;

    public $student_id, $student_nama;
    public $prestasi_id, $tanggal, $tingkat, $peringkat, $deskripsi;

    #[Title('Detail Prestasi')]

    public function mount($id)
    {
        $student = Student::find($id);
        $this->student_id = $student->id;
        $this->student_nama = $student->nama;
    }
    public function render()
    {

        $prestasis = Prestasi::where('student_id', $this->student_id)
            ->when($this->search, function ($query) {
                $query->where('tanggal', 'like', '%' . $this->search . '%')
                    ->orWhere('tingkat', 'like', '%' . $this->search . '%')
                    ->orWhere('peringkat', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.admin.kesantrian.detail-prestasi', compact('prestasis'));
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
        $this->prestasi_id = '';
        $this->tanggal = '';
        $this->tingkat = '';
        $this->peringkat = '';
        $this->deskripsi = '';

    }
    public function store()
    {
        $validation = $this->validate([
            'student_id' => 'required',
            'tanggal' => 'required|date',
            'tingkat' => 'required',
            'peringkat' => 'required',
            'deskripsi' => 'nullable',
        ], [
            'student_id.required' => 'Siswa wajib dipilih',
            'tanggal.required' => 'Tanggal Wajib Di isi',
            'tanggal.date' => 'Format Tanggal tidak sesuai',
            'peringkat.required' => 'Peringkat Wajib diisi',
        ]);

        Prestasi::create($validation);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Ditambahakan');

    }
    public function edit($id)
    {
        $prestasi = Prestasi::find($id);
        $this->prestasi_id = $id;
        $this->tanggal = $prestasi->tanggal;
        $this->tingkat = $prestasi->tingkat;
        $this->peringkat = $prestasi->peringkat;
        $this->deskripsi = $prestasi->deskripsi;

    }
    public function update()
    {
        $validation = $this->validate([
            'student_id' => 'required',
            'tanggal' => 'required|date',
            'tingkat' => 'required',
            'peringkat' => 'required',
            'deskripsi' => 'nullable',
        ], [
            'student_id.required' => 'Siswa wajib dipilih',
            'tanggal.required' => 'Tanggal Wajib Di isi',
            'tanggal.date' => 'Format Tanggal tidak sesuai',
            'peringkat.required' => 'Peringkat Wajib diisi',
        ]);

        Prestasi::find($this->prestasi_id)->update($validation);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Diubah');
    }
    public function destroy($id)
    {
        Prestasi::find($id)->delete();
        $this->alert('success', 'Data Berhasil hapus');
    }

}
