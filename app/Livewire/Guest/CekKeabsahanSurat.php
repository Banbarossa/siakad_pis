<?php

namespace App\Livewire\Guest;

use App\Models\PengajuanSurat;
use Livewire\Component;

class CekKeabsahanSurat extends Component
{

    public $surat;

    public function mount($code)
    {
        $this->surat = PengajuanSurat::with('student')->where('kode_surat', $code)->first();
    }

    public function render()
    {

        return view('livewire.guest.cek-keabsahan-surat')->layout('layouts.guest');
    }
}
