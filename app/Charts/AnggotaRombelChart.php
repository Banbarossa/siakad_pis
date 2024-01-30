<?php

namespace App\Charts;

use App\Models\AnggotaRombel;
use App\Models\Rombel;
use App\Models\Semester;
use App\Traits\SemesterAktif;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AnggotaRombelChart
{
    protected $chart;
    use SemesterAktif;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $semester = Semester::find($this->getAktifSemester()->id)->with('tahunAjaran')->first();
        $title = $semester->semester . ' | ' . $semester->tahunAjaran->tahun;

        $models = Rombel::with('sekolah')
            ->where('semester_id', $this->getAktifSemester()->id)
            ->orderBy('tingkat_kelas', 'asc')
            ->orderBy('nama_rombel', 'asc')
            ->get();

        $rombels = [];
        $data = [];
        foreach ($models as $model) {

            $jumlah_anggota = AnggotaRombel::where('rombel_id', $model->id)->where('semester_id', $this->getAktifSemester()->id)->count();
            $rombels[] = $model->nama_rombel;
            $data[] = $jumlah_anggota;
        }

        $chart = $this->chart->lineChart()
            ->setTitle($title)
            ->setSubtitle('Dat Santri Berdasakan Rombel')
            ->setHeight(280);
        if (!empty($data)) {
            $chart->addData('Jumlah Siswa', $data);
        }
        if (!empty($rombels)) {
            $chart->setXAxis($rombels);
        }
        return $chart;
    }
}
