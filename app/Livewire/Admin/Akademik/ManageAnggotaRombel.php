<?php

namespace App\Livewire\Admin\Akademik;

use App\Exports\AnggotaRombel as ExportsAnggotaRombel;
use App\Models\AnggotaRombel;
use App\Models\Rombel;
use App\Models\Semester;
use App\Models\Student;
use App\Traits\SemesterAktif;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ManageAnggotaRombel extends Component
{

    public $rombel_aktif, $semester_aktif, $semester_login, $canAddAnggota = false;

    public $search, $searchBelumMasuk, $perPage = 15;

    public $selectedStudent = [], $selectSemua, $jenis_pendaftaran;

    public $sortColumn, $sortDirection;

    public $title = 'Anggota Rombel';

    use LivewireAlert;

    use WithPagination;

    use SemesterAktif;

    protected $paginationTheme = 'bootstrap';

    #[Title('Anggota Rombel')]
    public function mount($id)
    {
        $this->rombel_aktif = Rombel::find($id);

        $this->semester_login = $this->getAktifSemester();
        $this->semester_aktif = Semester::where('status', true)->first();

        if ($this->semester_login->id == $this->semester_aktif->id) {
            $this->canAddAnggota = true;
        }
    }

    public function render()
    {

        $anggotaRombels = AnggotaRombel::with('student')->where('semester_id', $this->getAktifSemester()->id)
            ->where('rombel_id', $this->rombel_aktif->id)
            ->when($this->search, function ($query) {
                $query->whereHas('student', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate($this->perPage);

        $siswa_belum_masuk_kelas = Student::where('status_siswa', 'aktif')->where('rombel_id', null)
            ->when($this->searchBelumMasuk, function ($query) {
                $query->where('nama', 'like', '%' . $this->searchBelumMasuk . '%');
            })
            ->when(!empty($this->selectedStudent), function ($query) {
                $query->whereNotIn('id', $this->selectedStudent);
            })
            ->get();
        foreach ($siswa_belum_masuk_kelas as $belum_masuk_kelas) {
            $kelas_sebelumhya = AnggotaRombel::where('student_id', $belum_masuk_kelas->id)->orderBy('id', 'DESC')->first();
            if (is_null($kelas_sebelumhya)) {
                $belum_masuk_kelas->kelas_sebelumhya = null;
            } else {
                $belum_masuk_kelas->kelas_sebelumhya = $kelas_sebelumhya->rombel->nama_rombel;
            }
        }

        if (!empty($this->selectedStudent)) {
            $siswa_terpilih = Student::whereIn('id', $this->selectedStudent)->get();
        } else {
            $siswa_terpilih = [];
        }

        return view('livewire.admin.akademik.manage-anggota-rombel', compact('anggotaRombels', 'siswa_belum_masuk_kelas', 'siswa_terpilih'));
    }

    public function assignAllToRombel()
    {
        $this->validate([
            'jenis_pendaftaran' => 'required|numeric',
        ]);
        $data = $this->selectedStudent;

        foreach ($data as $item) {
            Student::find($item)->update([
                'rombel_id' => $this->rombel_aktif->id,
            ]);
            AnggotaRombel::create([
                'pendaftaran' => $this->jenis_pendaftaran,
                'semester_id' => $this->getAktifSemester()->id,
                'student_id' => $item,
                'rombel_id' => $this->rombel_aktif->id,
            ]);
        }

        $this->alert('success', 'Santri Berhasil dimasukkan ke rombel');
        $this->dispatch('close-modal');
        $this->selectedStudent = [];
    }

    public function clear()
    {
        $this->jenis_pendaftaran = '';
        $this->selectedStudent = [];
    }

    public function destroy($id)
    {
        $anggotaRombel = AnggotaRombel::find($id);
        $student = Student::find($anggotaRombel->student_id);
        try {
            $student->update([
                'rombel_id' => null,
            ]);
            $anggotaRombel->delete();
            $this->alert('success', 'Anggota Rombel berhasil dikeluarkan');

        } catch (Throwable $th) {
            $this->alert('error', 'Anggota Rombel tidak dapat dikeluarkan');
        }
    }

    public function download()
    {

        $filename = 'anggota_rombel ' . $this->rombel_aktif->nama_rombel . date('Y-m-d H_i_s') . '.xls';
        return Excel::download(new ExportsAnggotaRombel($this->rombel_aktif->id), $filename);
    }

}
