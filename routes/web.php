<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CetakSuratAktifController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\Akademik\ManageAnggotaRombel;
use App\Livewire\Admin\Akademik\ManageSekolah;
use App\Livewire\Admin\Akademik\RomblePerSekolah;
use App\Livewire\Admin\Akademik\Rombonganbelajar;
use App\Livewire\Admin\Cetak\SuratAktifSiswa;
use App\Livewire\Admin\Kesantrian\BeasiswaSantri;
use App\Livewire\Admin\Kesantrian\PelanggaranSantri;
use App\Livewire\Admin\Kesantrian\PrestasiSantri;
use App\Livewire\Admin\Mapel\MataPelajaran;
use App\Livewire\Admin\Pengaturan\TahunSemester;
use App\Livewire\Guest\PencarianSantri;
use App\Livewire\Student\Cetak\SuratAktif;
use App\Livewire\Student\Dashboard;
use App\Livewire\Student\KalenderAkademik;
use App\Livewire\Student\Kesantrian\Pelanggaran;
use App\Livewire\Student\Kesantrian\StudentAchievement;
use App\Livewire\Student\Kesantrian\StudentScolarship;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Sementara
Route::get('rapor', function () {

    $pdf = Pdf::loadView('rapor');
    return $pdf->stream();
    // return view('rapor');
});

//

Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('find-santri', PencarianSantri::class)->name('find.santri');
    Route::get('cek-surat/{code}', [CetakSuratAktifController::class, 'cekSurat'])->name('cek.surat');

});

// Student Area middleware('student')->
Route::middleware(['auth', 'student'])->prefix('student')->as('student.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('profile', \App\Livewire\Student\Profile::class)->name('profile');
    Route::get('kalender', KalenderAkademik::class)->name('kalender');
    Route::get('kesantrian/pelanggaran', Pelanggaran::class)->name('kesantrian.pelanggaran');
    Route::get('kesantrian/achievement', StudentAchievement::class)->name('kesantrian.prestasi');
    Route::get('kesantrian/scholarship', StudentScolarship::class)->name('kesantrian.beasiswa');
    Route::get('cetak/surat-aktif', SuratAktif::class)->name('cetak.surat-aktif');
    Route::get('generate/surat-aktif/{id}', [CetakSuratAktifController::class, 'index'])->name('generate.surat-aktif');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', AdminDashboard::class)->name('dashboard');

    Route::middleware(['can:Kelola Data Kepengasuhan'])->prefix('kesantrian')->as('kesantrian.')->group(function () {
        Route::get('/rekap', \App\Livewire\Admin\Kesantrian\RekapKesantrian::class)->name('rekap');
        Route::get('/prestasi/{id}', \App\Livewire\Admin\Kesantrian\DetailPrestasi::class)->name('detail.prestasi');
        Route::get('/beasiswa/{id}', \App\Livewire\Admin\Kesantrian\DetailBeasiswa::class)->name('detail.beasiswa');
        Route::get('/pelanggaran/{id}', \App\Livewire\Admin\Kesantrian\DetailPelanggaran::class)->name('detail.pelanggaran');
        Route::get('/pelanggaran', PelanggaranSantri::class)->name('pelanggaran');
        Route::get('/prestasi', PrestasiSantri::class)->name('prestasi');
        Route::get('/beasiswa', BeasiswaSantri::class)->name('beasiswa');

    });

    Route::middleware(['can:Cetak Surat'])->prefix('cetak')->as('cetak.')->group(function () {
        Route::get('/surat-aktif', SuratAktifSiswa::class)->name('surat-aktif');
        Route::get('/surat-aktif/siswa/{id}', [CetakSuratAktifController::class, 'adminCetak'])->name('surat-aktif.siswa');
    });

    Route::get('/profile', \App\Livewire\ProfileUser::class)->name('profile');

    Route::middleware(['can:Kelola Santri'])->prefix('santri')->as('siswa.')->group(function () {
        Route::get('/santri-lulus', \App\Livewire\Admin\Santri\SantriLulus::class)->name('lulus');
        Route::get('/siswa-aktif', \App\Livewire\Admin\Siswa\SiswaAktif::class)->name('aktif');
        Route::get('/siswa-yatim', \App\Livewire\Admin\Siswa\SiswaYatim::class)->name('yatim');
        Route::get('/tambah-siswa', \App\Livewire\Admin\Siswa\TambahSiswa::class)->name('tambah');
        Route::get('/detail/{id}', \App\Livewire\Admin\Siswa\ShowStudentDetail::class)->name('detail');
        Route::get('/edit/{id}', \App\Livewire\Admin\Siswa\EditSiswa::class)->name('edit');
        Route::get('/santri-mutasi', \App\Livewire\Admin\Santri\SantriPindah::class)->name('mutasi.keluar');
        Route::get('/detail-santri/{student}', \App\Livewire\Admin\Santri\DetailSantri::class)->name('.view');
    });
});

Route::middleware(['auth', 'admin', 'can:Kelola Master Data'])->prefix('admin/master')->as('admin.master.')->group(function () {
    // Route::get('/guru', \App\Livewire\Admin\Guru\KelolaGuru::class)->name('guru');
    Route::get('/tahun-semester', TahunSemester::class)->name('tahun-semester');
    Route::get('/sekolah', ManageSekolah::class)->name('sekolah');
    Route::get('/rombel', Rombonganbelajar::class)->name('rombel');
    Route::get('/rombel/{id}', RomblePerSekolah::class)->name('rombel.sekolah');
    Route::get('/rombel/anggota/{id}', ManageAnggotaRombel::class)->name('rombel.anggota');
    Route::get('/mata-pelajaran', MataPelajaran::class)->name('matapelajaran');

});

Route::middleware(['auth', 'admin', 'can:Kelola Pegawai'])->prefix('admin/pegawai')->as('admin.pegawai.')->group(function () {
    Route::get('/index', \App\Livewire\Admin\Pegawai\ListPegawai::class)->name('index');
    Route::get('/non-aktif', \App\Livewire\Admin\Pegawai\PegawaiNonAktif::class)->name('nonaktif');
    Route::get('/create', \App\Livewire\Admin\Pegawai\TambahPegawai::class)->name('index.create');
    Route::get('/update/{id}', \App\Livewire\Admin\Pegawai\UpdatePegawai::class)->name('index.update');
    Route::get('/show/{id}', \App\Livewire\Admin\Pegawai\ShowPegawaiDetail::class)->name('show');
});
Route::middleware(['auth', 'admin', 'can:Kelola Akun'])->prefix('admin/akun')->as('admin.akun.')->group(function () {
    Route::get('/pegawai', \App\Livewire\Admin\Akun\Pegawai::class)->name('pegawai');
    Route::get('/role', \App\Livewire\Admin\Akun\ManageRole::class)->name('role');
    Route::get('/permission', \App\Livewire\Admin\Akun\ManagePermissions::class)->name('permission');
    Route::get('/role-permission/{id}', \App\Livewire\Admin\Akun\RolePermission::class)->name('role.permission');
});
