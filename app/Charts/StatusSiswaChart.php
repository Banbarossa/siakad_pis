<?php

namespace App\Charts;

use App\Models\AnggotaRombel;
use App\Models\Rombel;
use App\Models\Semester;
use App\Traits\SemesterAktif;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StatusSiswaChart
{
    protected $chart;

    use SemesterAktif;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $semester = Semester::find($this->getAktifSemester()->id)->with('tahunAjaran')->first();
        $title = $semester->semester . ' | ' . $semester->tahunAjaran->tahun;

        $models = Rombel::with('sekolah')
            ->where('semester_id', $this->getAktifSemester()->id)
            ->orderBy('tingkat_kelas', 'asc')
            ->orderBy('nama_rombel', 'asc')
            ->get();

        $rombels = [];
        $jumlahyatim = [];
        $jumlahnnonyatim = [];
        foreach ($models as $model) {

            $yatim = AnggotaRombel::whereHas('student', function ($query) {
                $query->where('status_siswa', 'aktif')
                    ->where(function ($q) {
                        $q->where('status_sosial', 'yatim')
                            ->orWhere('status_sosial', 'yatim piatu');

                    });

            })
                ->where('rombel_id', $model->id)->where('semester_id', $this->getAktifSemester()->id)->count();

            $nonyatim = AnggotaRombel::whereHas('student', function ($query) {
                $query->where('status_siswa', 'aktif')
                    ->where(function ($q) {
                        $q->where('status_sosial', 'non yatim')
                            ->orWhere('status_sosial', 'piatu');

                    });

            })
                ->where('rombel_id', $model->id)->where('semester_id', $this->getAktifSemester()->id)->count();

            $rombels[] = $model->nama_rombel;
            $jumlahyatim[] = $yatim;
            $jumlahnonyatim[] = $nonyatim;
        }

        $chart = $this->chart->barChart()
            ->setTitle($title)
            ->setSubtitle('Dat Santri Berdasakan Rombel')
            ->setHeight(280);
        if (!empty($jumlahnonyatim)) {
            $chart->addData('Non Yatim', $jumlahnonyatim);
        }
        if (!empty($jumlahyatim)) {
            $chart->addData('Yatim', $jumlahyatim);
        }
        if (!empty($rombels)) {
            $chart->setXAxis($rombels);
        }
        return $chart;

    }
}
