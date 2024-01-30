<?php

namespace App\Livewire\Student\Kesantrian;

use App\Models\Pelanggaran as Iqab;
use App\Models\User;
use App\Traits\SiswaInAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pelanggaran extends Component
{
    use SiswaInAccount;
    public $Idstudent;
    public $authId;

    public function mount()
    {
        $auth = Auth::user()->id;
        $this->authId = $auth;
        $siswa = $this->SiswaAktif();
        if ($siswa->count() > 0) {
            $this->Idstudent = $siswa->first()->id;
        }
    }
    public function render()
    {

        $siswa = $this->SiswaAktif();

        $pelanggaran = Iqab::where('student_id', $this->Idstudent)->where('is_show', 1)->latest()->get();
        return view('livewire.student.kesantrian.pelanggaran', [
            'pelanggaran' => $pelanggaran,
            'siswa' => $siswa,

        ])->layout('layouts.student-layout');
    }

    public function changeStudent($idSiswa)
    {

        $this->Idstudent = $idSiswa;

    }

}
