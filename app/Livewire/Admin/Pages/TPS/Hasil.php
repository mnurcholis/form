<?php

namespace App\Livewire\Admin\Pages\TPS;

use App\Models\Hasil as ModelsHasil;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Hasil extends Component
{
    public $chartGubernur = [];
    public $chartBupati = [];

    protected $listeners = ['chartDataUpdated' => 'updateChartData'];

    public function mount()
    {
        $this->updateChartData();
    }

    public function updateChartData()
    {
        // Update data gubernur
        $this->chartGubernur = ModelsHasil::select(
            'com_regions.region_nm as region',
            DB::raw('SUM(g_1) as total_g1'),
            DB::raw('SUM(g_2) as total_g2'),
            DB::raw('SUM(g_ts) as total_gts')
        )
            ->join('com_regions', 'hasils.kecamatan', '=', 'com_regions.region_cd')
            ->groupBy('com_regions.region_nm')
            ->get()
            ->toArray();

        // Update data bupati
        $this->chartBupati = ModelsHasil::select(
            'com_regions.region_nm as region',
            DB::raw('SUM(b_1) as total_b1'),
            DB::raw('SUM(b_2) as total_b2'),
            DB::raw('SUM(b_ts) as total_bts')
        )
            ->join('com_regions', 'hasils.kecamatan', '=', 'com_regions.region_cd')
            ->groupBy('com_regions.region_nm')
            ->get()
            ->toArray();

        // Emit ke frontend untuk update chart
        $this->emitSelf('refreshChart', $this->chartGubernur, $this->chartBupati);
    }

    public function render()
    {
        return view('livewire.admin.pages.t-p-s.hasil')->layout('layouts.luar');
    }
}
