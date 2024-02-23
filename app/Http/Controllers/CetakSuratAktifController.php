<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\PengajuanSurat;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CetakSuratAktifController extends Controller
{
    public function index($id)
    {

        $student = Student::login()->first();

        $pengajuan = PengajuanSurat::with('student')->find($id);

        if ($pengajuan->student_id != $student->id) {
            return abort(403, 'Unauthorized action.');
        } else {

            $lembaga = Lembaga::latest()->first();

            $route = route('cek.surat', $pengajuan->kode_unik);

            $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($route));
            $pdf = Pdf::loadView('cetak.surat-aktif', [
                'pengajuan' => $pengajuan,
                'qrcode' => $qrcode,
                'lembaga' => $lembaga,
            ])->setPaper('a4', 'potrait');
            return $pdf->stream();
        }

    }

    public function cekSurat($code)
    {
        $pengajuan = PengajuanSurat::with('student')->where('kode_unik', $code)->first();

        if ($pengajuan) {
            $lembaga = Lembaga::latest()->first();

            $route = route('cek.surat', $pengajuan->kode_unik);

            $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($route));
            $pdf = Pdf::loadView('cetak.surat-aktif', [
                'pengajuan' => $pengajuan,
                'qrcode' => $qrcode,
                'lembaga' => $lembaga,
            ])->setPaper('a4', 'potrait');
            return $pdf->stream();
        } else {
            return view('not-found');
        }
    }

    public function adminCetak($id)
    {

        $pengajuan = PengajuanSurat::with('student')->find($id);

        $lembaga = Lembaga::latest()->first();

        $route = route('cek.surat', $pengajuan->kode_unik);

        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($route));
        $pdf = Pdf::loadView('cetak.surat-aktif', [
            'pengajuan' => $pengajuan,
            'qrcode' => $qrcode,
            'lembaga' => $lembaga,
        ])->setPaper('a4', 'potrait');
        return $pdf->stream();

    }
}
