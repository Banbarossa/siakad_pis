<?php
namespace App\Traits;

use App\Models\Semester;
use App\Models\TahunAjaran;

trait SemesterAktif
{
    public static function getAktifSemester()
    {
        if (session()->has('semester_id')) {
            return Semester::with('tahunAjaran')->find(session()->get('semester_id'));

        } else {
            $tahunAktif = TahunAjaran::whereStatus(true)->first();
            return Semester::with('tahunAjaran')->where('tahun_ajaran_id', $tahunAktif->id)->first();
        }

    }
}
