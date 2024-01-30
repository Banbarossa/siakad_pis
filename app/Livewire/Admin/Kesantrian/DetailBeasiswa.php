<?php

namespace App\Livewire\Admin\Kesantrian;

use App\Models\Scholarship;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class DetailBeasiswa extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search, $perPage = 15, $sortColumn = 'tanggal_terima', $sortDirection = 'desc';
    public $student_id;
    public $student_nama;

    public $beasiswa_id, $tahun, $bulan, $tanggal_terima, $sumber, $jumlah;

    public function mount($id)
    {
        $student = Student::where('status_siswa', 'aktif')->where('id', $id)->first();

        $this->student_id = $student->id;
        $this->student_nama = $student->nama;

    }
    public function render()
    {

        $beasiswa = Scholarship::where('student_id', $this->student_id)
            ->when($this->search, function ($query) {
                $query->where('tahun', 'like', '%' . $this->search . '%');
                $query->orWhere('bulan', 'like', '%' . $this->search . '%');
                $query->orWhere('tanggal_terima', 'like', '%' . $this->search . '%');
                $query->orWhere('sumber', 'like', '%' . $this->search . '%');
                $query->orWhere('jumlah', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.admin.kesantrian.detail-beasiswa', compact('beasiswa'));
    }

    public function sortTable($column)
    {
        $this->sortColumn = $column;
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
    }
    public function clear()
    {
        $this->beasiswa_id = '';
        $this->tahun = '';
        $this->bulan = '';
        $this->tanggal_terima = '';
        $this->sumber = '';
        $this->jumlah = '';

    }

    public function rules()
    {
        return [
            'student_id' => 'required',
            'tahun' => 'required|numeric|digits:4',
            'bulan' => 'required',
            'tanggal_terima' => 'required',
            'sumber' => 'required',
            'jumlah' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'student_id.required' => 'Siswa Id Wajib Di isi.',
            'tahun.required' => 'Tahun Wajib Diisi.',
            'tahun.numeric' => 'Tahun harus berupa angka.',
            'tahun.digits' => 'Tahun harus terdiri dari 4 digit.',
            'bulan.required' => 'Mohon pilih bulan.',
            'tanggal_terima.required' => 'Mohon masukkan tanggal terima.',
            'sumber.required' => 'Mohon pilih sumber.',
            'jumlah.required' => 'Mohon masukkan jumlah.',
        ];
    }

    public function store()
    {
        $jumlahAngka = preg_replace('/\D/', '', $this->jumlah);
        $jumlah = (int) $jumlahAngka;
        $this->validate();
        Scholarship::create([
            'student_id' => $this->student_id,
            'tahun' => $this->tahun,
            'bulan' => $this->bulan,
            'tanggal_terima' => $this->tanggal_terima,
            'sumber' => $this->sumber,
            'jumlah' => $jumlah,
        ]);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Ditambahakan');
    }

    public function edit($id)
    {
        $beasiswa = Scholarship::find($id);
        $this->beasiswa_id = $id;
        $this->tahun = $beasiswa->tahun;
        $this->bulan = $beasiswa->bulan;
        $this->tanggal_terima = $beasiswa->tanggal_terima;
        $this->sumber = $beasiswa->sumber;
        $this->jumlah = $beasiswa->jumlah;
    }
    public function update()
    {
        $jumlahAngka = preg_replace('/\D/', '', $this->jumlah);
        $jumlah = (int) $jumlahAngka;
        $this->validate();

        Scholarship::find($this->beasiswa_id)->update([
            'student_id' => $this->student_id,
            'tahun' => $this->tahun,
            'bulan' => $this->bulan,
            'tanggal_terima' => $this->tanggal_terima,
            'sumber' => $this->sumber,
            'jumlah' => $jumlah,
        ]);

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Scholarship::find($id)->delete();
        $this->alert('success', 'Data Berhasil dihapus');

    }
}
