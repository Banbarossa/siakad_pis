<?php

namespace App\Livewire\Admin\Kesantrian;

use App\Exports\PrestasiExport;
use App\Models\Prestasi;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PrestasiSantri extends Component
{

    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'tanggal', $sortDirection = 'desc';

    public $prestasi_id, $student_id, $tanggal, $tingkat, $peringkat, $deskripsi;

    public function render()
    {
        $prestasi = Prestasi::with('student');

        if ($this->search) {
            $prestasi = $prestasi->where(function ($query) {
                $query->where('tanggal', 'like', "%" . $this->search . "%")
                    ->orWhere('tanggal', 'like', "%" . $this->search . "%")
                    ->orWhere('peringkat', 'like', "%" . $this->search . "%")
                    ->orWhere('deskripsi', 'like', "%" . $this->search . "%")
                    ->orWhereHas('student', function ($query) {
                        $query->where('nama', 'like', "%" . $this->search . "%");
                    });
            });
        }

        $prestasi = $prestasi->orderBy($this->sortColumn, $this->sortDirection)->limit(500)->paginate($this->perPage);

        $students = Student::where('status_siswa', 'aktif')->orderBy('nama', 'asc')->get();

        return view('livewire.admin.kesantrian.prestasi-santri', [
            'prestasi' => $prestasi,
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

    public function clear()
    {
        $this->prestasi_id = '';
        $this->student_id = '';
        $this->tanggal = '';
        $this->tingkat = '';
        $this->peringkat = '';
        $this->deskripsi = '';

    }

    public function edit($id)
    {
        $prestasi = Prestasi::find($id);
        $this->prestasi_id = $id;
        $this->student_id = $prestasi->student_id;
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

    public function export()
    {
        $filename = 'daftar_prestasi ' . date('Y_m_d H_i_s') . '.xls';
        return Excel::download(new PrestasiExport, $filename);
    }

}
