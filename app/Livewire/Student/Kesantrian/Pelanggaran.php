<?php

namespace App\Livewire\Student\Kesantrian;

use App\Models\Pelanggaran as Iqab;
use App\Models\Student;
use App\Traits\SiswaInAccount;
use Livewire\Component;

class Pelanggaran extends Component
{
    use SiswaInAccount;

    public $tanggal;
    public $jam;
    public $level_pelanggaran;
    public $deskripsi;
    public $penanganan;
    public $point;

    public function render()
    {

        $siswa = Student::login()->first();

        $pelanggaran = Iqab::where('student_id', $siswa->id)
            ->where('is_show', true)
            ->latest()->limit(5)->get();

        return view('livewire.student.kesantrian.pelanggaran', [
            'pelanggaran' => $pelanggaran,

        ]);
    }

    public function getDetail($id)
    {
        $iqab = Iqab::findOrFail($id);

        $this->tanggal = $iqab->tanggal;
        $this->jam = $iqab->jam;
        $this->level_pelanggaran = $iqab->level_pelanggaran;
        $this->deskripsi = $iqab->deskripsi;
        $this->penanganan = $iqab->penanganan;
        $this->point = $iqab->point;
    }

}
