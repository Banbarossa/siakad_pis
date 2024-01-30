<?php
namespace App\Traits;

use App\Models\Semester;

trait SemesterAktif
{
    public static function getAktifSemester()
    {

        return Semester::with('tahunAjaran')->find(session()->get('semester_id'));
    }
}
