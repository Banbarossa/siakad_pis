<?php

namespace App\Livewire\Student\Kesantrian;

use App\Models\Prestasi;
use App\Models\Student;
use Livewire\Component;

class StudentAchievement extends Component
{

    public $tanggal;
    public $tingkat;
    public $peringkat;
    public $deskripsi;

    public function render()
    {

        $siswa = Student::login()->first();

        $achievements = Prestasi::where('student_id', $siswa->id)
            ->latest()->limit(5)->get();

        return view('livewire.student.kesantrian.student-achievement', [
            'achievements' => $achievements,
        ]);
    }

    public function getDetail($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $this->tanggal = $prestasi->tanggal;
        $this->tingkat = $prestasi->tingkat;
        $this->peringkat = $prestasi->peringkat;
        $this->deskripsi = $prestasi->deskripsi;
    }
}
