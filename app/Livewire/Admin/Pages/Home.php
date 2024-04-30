<?php

namespace App\Livewire\Admin\Pages;

use App\Exports\RekapLilaExport;
use App\Models\ComRegion;
use App\Models\Lila;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Home extends Component
{
    public $region_kec, $region_kel, $kecamatan, $desa;

    public function exportData()
    {
        $query = Lila::select(
            'com_regions.region_nm AS nama_desa',
            DB::raw('SUM(IF(lilas.lila >= com_codes.code_value, 1, 0)) AS tidakkek'),
            DB::raw('SUM(IF(lilas.lila < com_codes.code_value, 1, 0)) AS kek'),
            DB::raw('COUNT(id) AS jumlah')
        )
            ->join('com_regions', 'com_regions.region_cd', '=', 'lilas.desa')
            ->join('com_codes', 'com_codes.code_cd', '=', 'lilas.usia_tp')
            ->groupBy('nama_desa');
        $namefile = '';
        if ($this->kecamatan) {
            $query->where('kecamatan', 'like', '%' . $this->kecamatan . '%');
            $namefile .= ComRegion::where('region_cd', $this->kecamatan)->first()->region_nm . '_';
        }
        if ($this->desa) {
            $query->where('desa', 'like', '%' . $this->desa . '%');
            $namefile .= ComRegion::where('region_cd', $this->desa)->first()->region_nm . '_';
        }
        $query = $query->get();

        return Excel::download(new RekapLilaExport($query), 'Data_lila_' . $namefile . time() . '.xlsx');
    }

    public function updateFormKecamatan()
    {
        $this->region_kel = ComRegion::where('region_root', $this->kecamatan)->get()->toArray();
        $this->desa = null;
    }

    public function mount()
    {
        $this->region_kec = ComRegion::where('region_level', '3')->get();
    }
    public function render()
    {
        $query = Lila::select(
            'com_regions.region_nm AS nama_desa',
            DB::raw('SUM(IF(lilas.lila >= com_codes.code_value, 1, 0)) AS tidakkek'),
            DB::raw('SUM(IF(lilas.lila < com_codes.code_value, 1, 0)) AS kek'),
            DB::raw('COUNT(id) AS jumlah')
        )
            ->join('com_regions', 'com_regions.region_cd', '=', 'lilas.desa')
            ->join('com_codes', 'com_codes.code_cd', '=', 'lilas.usia_tp')
            ->groupBy('nama_desa');

        if ($this->kecamatan) {
            $query->where('kecamatan', 'like', '%' . $this->kecamatan . '%');
        }
        if ($this->desa) {
            $query->where('desa', 'like', '%' . $this->desa . '%');
        }

        $query = $query->get();

        return view('livewire.admin.pages.home', [
            'data' => $query,
        ]);
    }
}
