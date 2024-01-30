<?php

namespace App\Traits;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

trait SiswaInAccount
{
    public function SiswaAktif()
    {
        $siswa = Student::with('users')->where('status_siswa', 'aktif')->whereHas('users', function ($query) {
            $query->where('users.id', Auth::user()->id);
        })->get();

        return $siswa;
    }
}
