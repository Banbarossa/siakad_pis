<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
use App\Livewire\Guest\CekKeabsahanSurat;
use App\Livewire\Guest\PencarianSantri;
use App\Livewire\Student\Cetak\SuratAktif;
use App\Livewire\Student\Dashboard;
use App\Livewire\Student\KalenderAkademik;
use App\Livewire\Student\Kesantrian\Pelanggaran;
use App\Livewire\Student\Kesantrian\StudentAchievement;
use App\Livewire\Student\Kesantrian\StudentScolarship;
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
    return view('rapor');
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
    Route::get('cek-surat/{code}', CekKeabsahanSurat::class)->name('cek.surat');

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
});

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', AdminDashboard::class)->name('dashboard');
    // Route::get('/akun/siswa', AkunSiswa::class)->name('akun.siswa');
    // Route::get('/santri/santri-aktif', \App\Livewire\Admin\Santri\SantriAktif::class)->name('santri.aktif');
    Route::get('/santri/santri-lulus', \App\Livewire\Admin\Santri\SantriLulus::class)->name('santri.lulus');

    // Route::get('/santri/tambah-santri', TambahSantri::class)->name('santri.tambah');
    Route::get('/santri/detail-santri/{student}', \App\Livewire\Admin\Santri\DetailSantri::class)->name('santri.view');
    // Route::get('/santri/edit/{id}', TambahSantri::class)->name('santri.edit');
    Route::get('/kesantrian/rekap', \App\Livewire\Admin\Kesantrian\RekapKesantrian::class)->name('kesantrian.rekap');
    Route::get('/kesantrian/prestasi/{id}', \App\Livewire\Admin\Kesantrian\DetailPrestasi::class)->name('kesantrian.detail.prestasi');
    Route::get('/kesantrian/beasiswa/{id}', \App\Livewire\Admin\Kesantrian\DetailBeasiswa::class)->name('kesantrian.detail.beasiswa');
    Route::get('/kesantrian/pelanggaran/{id}', \App\Livewire\Admin\Kesantrian\DetailPelanggaran::class)->name('kesantrian.detail.pelanggaran');
    Route::get('/kesantrian/pelanggaran', PelanggaranSantri::class)->name('kesantrian.pelanggaran');
    Route::get('/kesantrian/prestasi', PrestasiSantri::class)->name('kesantrian.prestasi');
    Route::get('/kesantrian/beasiswa', BeasiswaSantri::class)->name('kesantrian.beasiswa');

    Route::get('/cetak/surat-aktif', SuratAktifSiswa::class)->name('cetak.surat-aktif');
    Route::get('/profile', \App\Livewire\ProfileUser::class)->name('profile');

    // ujicoba guardian
    Route::get('/santri/siswa-aktif', \App\Livewire\Admin\Siswa\SiswaAktif::class)->name('siswa.aktif');
    Route::get('/santri/tambah-siswa', \App\Livewire\Admin\Siswa\TambahSiswa::class)->name('siswa.tambah');
    Route::get('/santri/detail/{id}', \App\Livewire\Admin\Siswa\ShowStudentDetail::class)->name('siswa.detail')->middleware('can:Create Santri');
    Route::get('/santri/edit/{id}', \App\Livewire\Admin\Siswa\EditSiswa::class)->name('siswa.edit');
    Route::get('/santri/santri-mutasi', \App\Livewire\Admin\Santri\SantriPindah::class)->name('siswa.mutasi.keluar');
    // Route::get('/santri/edit-siswa/{id}', \App\Livewire\Admin\Siswa\TambahSiswa::class)->name('siswa.edit');

});
Route::middleware(['auth', 'admin'])->prefix('admin/master')->as('admin.master.')->group(function () {
    Route::get('/guru', \App\Livewire\Admin\Guru\KelolaGuru::class)->name('guru');
    Route::get('/tahun-semester', TahunSemester::class)->name('tahun-semester');
    Route::get('/sekolah', ManageSekolah::class)->name('sekolah');
    Route::get('/rombel', Rombonganbelajar::class)->name('rombel');
    Route::get('/rombel/{id}', RomblePerSekolah::class)->name('rombel.sekolah');
    Route::get('/rombel/anggota/{id}', ManageAnggotaRombel::class)->name('rombel.anggota');
    Route::get('/mata-pelajaran', MataPelajaran::class)->name('matapelajaran');

});

Route::middleware(['auth', 'admin'])->prefix('admin/pegawai')->as('admin.pegawai.')->group(function () {
    Route::get('/index', \App\Livewire\Admin\Pegawai\ListPegawai::class)->name('index');
    Route::get('/create', \App\Livewire\Admin\Pegawai\TambahPegawai::class)->name('index.create');
    Route::get('/update/{id}', \App\Livewire\Admin\Pegawai\UpdatePegawai::class)->name('index.update');
    Route::get('/show/{id}', \App\Livewire\Admin\Pegawai\ShowPegawaiDetail::class)->name('show');
});
Route::middleware(['auth', 'admin'])->prefix('admin/akun')->as('admin.akun.')->group(function () {
    Route::get('/pegawai', \App\Livewire\Admin\Akun\Pegawai::class)->name('pegawai');
    Route::get('/role', \App\Livewire\Admin\Akun\ManageRole::class)->name('role');
    Route::get('/permission', \App\Livewire\Admin\Akun\ManagePermissions::class)->name('permission');
    Route::get('/role-permission/{id}', \App\Livewire\Admin\Akun\RolePermission::class)->name('role.permission');
});
