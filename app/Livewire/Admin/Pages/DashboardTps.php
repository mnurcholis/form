<?php

namespace App\Livewire\Admin\Pages;

use App\Models\ComRegion;
use App\Models\Hasil;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardTps extends Component
{
    public $gubernur;
    public $bupati;

    public $chartBupati = [];
    public $chartGurbernur = [];

    public function mount()
    {
        // Misal data berasal dari table keuangan atau tabel lain
        $data = Hasil::get();
        // dd($data->sum('g_1'));
        $this->gubernur = [
            $data->sum('g_1'),
            $data->sum('g_2'),
            $data->sum('g_ts'),
        ];

        $this->bupati = [
            $data->sum('b_1'),
            $data->sum('b_2'),
            $data->sum('b_ts'),
        ];
        // dd($this->gubernur);

        $datachartBupati = Hasil::select('kecamatan', DB::raw('SUM(g_1) as total_g1'), DB::raw('SUM(g_2) as total_g2'), DB::raw('SUM(g_ts) as total_gts'))
            ->groupBy('kecamatan')
            ->get();
        foreach ($datachartBupati as $row) {
            $region = ComRegion::where('region_cd', $row->kecamatan)->first();
            $this->chartBupati[] = [
                'region' => $region->region_nm,
                'total_g1' => $row->total_g1,
                'total_g2' => $row->total_g2,
                'total_gts' => $row->total_gts,
            ];
        }

        $datachartGubernur = Hasil::select('kecamatan', DB::raw('SUM(b_1) as total_b1'), DB::raw('SUM(b_2) as total_b2'), DB::raw('SUM(b_ts) as total_bts'))
            ->groupBy('kecamatan')
            ->get();
        foreach ($datachartGubernur as $row) {
            $region = ComRegion::where('region_cd', $row->kecamatan)->first();
            $this->chartGurbernur[] = [
                'region' => $region->region_nm,
                'total_b1' => $row->total_b1,
                'total_b2' => $row->total_b2,
                'total_bts' => $row->total_bts,
            ];
        }
    }
    public function render()
    {
        return view('livewire.admin.pages.dashboard-tps');
    }
}
