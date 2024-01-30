<?php

namespace App\Livewire\Admin\Kesantrian;

use App\Exports\BeasiswaExport;
use App\Models\Scholarship;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class BeasiswaSantri extends Component
{
    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'created_at', $sortDirection = 'desc';
    public $beasiswa_id, $student_id, $tahun, $bulan, $tanggal_terima, $sumber, $jumlah;

    public function render()
    {

        $beasiswa = Scholarship::with('student');

        if ($this->search) {
            $beasiswa = $beasiswa->where(function ($query) {
                $query->where('tahun', 'like', "%" . $this->search . "%")
                    ->orWhere('bulan', 'like', "%" . $this->search . "%")
                    ->orWhere('sumber', 'like', "%" . $this->search . "%")
                    ->orWhereHas('student', function ($query) {
                        $query->where('nama', 'like', "%" . $this->search . "%");
                    });
            });
        }

        $beasiswa = $beasiswa->orderBy($this->sortColumn, $this->sortDirection)->limit(500)->paginate($this->perPage);

        $students = Student::where('status_siswa', 'aktif')->orderBy('nama', 'asc')->get();
        return view('livewire.admin.kesantrian.beasiswa-santri', [
            'beasiswa' => $beasiswa,
            'students' => $students,
        ])->layout('layouts.admin-layout');
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
        $this->beasiswa_id = '';
        $this->student_id = '';
        $this->tahun = '';
        $this->bulan = '';
        $this->tanggal_terima = '';
        $this->sumber = '';
        $this->jumlah = '';

    }

    public function store()
    {
        $jumlahAngka = preg_replace('/\D/', '', $this->jumlah);
        $jumlah = (int) $jumlahAngka;
        $this->validate([
            'student_id' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'tanggal_terima' => 'required',
            'sumber' => 'required',
            'jumlah' => 'required',
        ]);

        Scholarship::create([
            'student_id' => $this->student_id,
            'tahun' => $this->tahun,
            'bulan' => $this->bulan,
            'tanggal_terima' => $this->tanggal_terima,
            'sumber' => $this->sumber,
            'jumlah' => $jumlah,
        ]);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Ditambahakan');
    }

    public function edit($id)
    {
        $beasiswa = Scholarship::find($id);
        $this->beasiswa_id = $id;
        $this->student_id = $beasiswa->student_id;
        $this->tahun = $beasiswa->tahun;
        $this->bulan = $beasiswa->bulan;
        $this->tanggal_terima = $beasiswa->tanggal_terima;
        $this->sumber = $beasiswa->sumber;
        $this->jumlah = $beasiswa->jumlah;
    }

    public function update()
    {
        $jumlahAngka = preg_replace('/\D/', '', $this->jumlah);
        $jumlah = (int) $jumlahAngka;
        $this->validate([
            'student_id' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'tanggal_terima' => 'required',
            'sumber' => 'required',
            'jumlah' => 'required',
        ]);

        Scholarship::find($this->beasiswa_id)->update([
            'student_id' => $this->student_id,
            'tahun' => $this->tahun,
            'bulan' => $this->bulan,
            'tanggal_terima' => $this->tanggal_terima,
            'sumber' => $this->sumber,
            'jumlah' => $jumlah,
        ]);

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Scholarship::find($id)->delete();
        $this->alert('success', 'Data Berhasil dihapus');
    }

    public function export()
    {
        $filename = 'beasiswa_santri ' . date('Y_m_d H_i_s') . '.xls';
        return Excel::download(new BeasiswaExport, $filename);
    }
}
