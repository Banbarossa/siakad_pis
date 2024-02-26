<?php

namespace App\Livewire\Dashboard;

use App\Charts\StatusSiswaChart;
use Livewire\Component;

class CountBaseOnStatusSosial extends Component
{
    public function render(StatusSiswaChart $chart)
    {

        return view('livewire.dashboard.count-base-on-status-sosial', ['grafik' => $chart->build()]);
    }
}
