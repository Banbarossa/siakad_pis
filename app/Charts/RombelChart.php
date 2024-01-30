<?php

namespace App\Charts;

use App\Models\AnggotaRombel;
use App\Models\Rombel;
use App\Traits\SemesterAktif;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class RombelChart
{
    protected $chart;
    use SemesterAktif;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $semester = $this->getAktifSemester();
        $models = Rombel::where('semester_id', $semester->id)->with('sekolah')->get();

        $labels = [];
        $data = [];

        foreach ($models as $model) {
            $jumlah_anggota = AnggotaRombel::where('rombel_id', $model->id)
                ->where('semester_id', $this->getAktifSemester()->id)
                ->count();

            $labels[] = $model->nama_rombel;
            $data[] = $jumlah_anggota;
        }
        return $this->chart->pieChart()
            ->setTitle('Top 3 scorers of the team.')
            ->setSubtitle($semester->semester)
            ->addData([20, 24, 30])
            ->setLabels(['Player 7', 'Player 10', 'Player 9']);
    }
}
