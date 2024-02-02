<?php

namespace App\Livewire\Student;

use App\Models\Student;
use App\Models\User;
use App\Traits\SiswaInAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Profile extends Component
{

    use LivewireAlert;
    use SiswaInAccount;
    public $old_password;
    public $new_password;
    public $password_confirmation;

    public $student;

    public function mount()
    {
        $auth = Auth::user()->id;
        $siswa = $this->SiswaAktif();
        $this->student = $siswa->first();
    }

    public function render()
    {
        $auth = Auth::user()->id;
        $siswa = $this->SiswaAktif();

        $pendidikansebelumnya = '';
        if ($this->student) {
            $pendidikansebelumnya = $this->student->riwayatpendidikans()
                ->where('is_latest', 1)
                ->latest()
                ->first();
        }

        return view('livewire.student.profile', [
            'pendidikansebelumnya' => $pendidikansebelumnya,
            'siswa' => $siswa,
        ])->layout('layouts.student-layout');
    }

    public function changeStudent($idSiswa)
    {

        $siswa = Student::where('id', $idSiswa)->first();
        $this->student = $siswa;

    }

    public function ubahPassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Lakukan pengecekan password lama di sini
        if (!Hash::check($this->password_lama, auth()->user()->password)) {
            $this->addError('old_password', 'Password lama tidak sesuai.');
        }

        // Proses penggantian password jika validasi berhasil
        if (!$this->hasErrors()) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($this->new_password);
            $user->save();

            $this->clear();

            $this->alert('success', 'Pasword Berhasil diubah');

        }
    }

    public function clear()
    {
        $this->old_password = '';
        $this->new_password = '';
        $this->password_confirmation = '';
    }
}
