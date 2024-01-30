<?php

namespace App\Livewire\Admin;

use App\Charts\AnggotaRombelChart;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\Student;
use App\Traits\SemesterAktif;
use Livewire\Component;

class AdminDashboard extends Component
{
    use SemesterAktif;
    public function render(AnggotaRombelChart $chart)
    {
        $student = Student::get();
        $rombels = Rombel::where('semester_id', $this->getAktifSemester()->id)->get();
        $sekolahs = Sekolah::all();
        foreach ($sekolahs as $sekolah) {
            $jumlahSiswa = Student::whereHas('anggotaRombels', function ($query) use ($sekolah) {
                $query->where('semester_id', $this->getAktifSemester()->id)
                    ->whereHas('rombel', function ($query) use ($sekolah) {
                        $query->whereHas('sekolah', function ($query) use ($sekolah) {
                            $query->where('tingkat', $sekolah->tingkat);
                        });
                    });
            })->count();

            $sekolah->jumlahSiswa = $jumlahSiswa;

        }

        // $SiswaSd = Student::whereHas('anggotaRombels', function ($query) {
        //     $query->where('semester_id', $this->getAktifSemester()->id)
        //         ->whereHas('rombel', function ($query) {
        //             $query->whereHas('sekolah', function ($query) {
        //                 $query->where('tingkat', 'Ibtidaiyyah');
        //             });
        //         });
        // })->count();
        // $SiswaSmp = Student::whereHas('anggotaRombels', function ($query) {
        //     $query->where('semester_id', $this->getAktifSemester()->id)
        //         ->whereHas('rombel', function ($query) {
        //             $query->whereHas('sekolah', function ($query) {
        //                 $query->where('tingkat', 'Mutawassithah');
        //             });
        //         });
        // })->count();
        // $SiswaMa = Student::whereHas('anggotaRombels', function ($query) {
        //     $query->where('semester_id', $this->getAktifSemester()->id)
        //         ->whereHas('rombel', function ($query) {
        //             $query->whereHas('sekolah', function ($query) {
        //                 $query->where('tingkat', 'Tsanawiyyah');
        //             });
        //         });
        // })->count();

        return view('livewire.admin.admin-dashboard', [
            'siswa' => $student,
            'sekolahs' => $sekolahs,
            'rombels' => $rombels,
            'chart' => $chart->build(),
        ]);
    }
}
