<?php

namespace App\Livewire\Admin\Pages\DataLila;

use App\Exports\LilaExport;
use App\Models\ComRegion;
use App\Models\Lila as ModelsLila;
use App\Models\Sekolah;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Lila extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $region_kec, $region_kel, $sekolah, $kecamatan, $desa, $usia_tp, $kategori_tp, $nama, $nik;

    public function updateFormKecamatan()
    {
        $this->region_kel = ComRegion::where('region_root', $this->kecamatan)->get()->toArray();
        $this->desa = null;
    }

    public function updateFormDesa()
    {
        $data = [
            'desa' => $this->desa,
            'kecamatan' => $this->kecamatan,
        ];
        // $this->emit('Cari', $data);
    }

    public function updateFormUsia()
    {
    }

    public function exportData()
    {
        $data = ModelsLila::join('sekolahs', 'sekolahs.id', '=', 'lilas.sekolah_id')
            ->join('com_codes as Usia', 'Usia.code_cd', '=', 'lilas.usia_tp', 'left')
            ->join('com_codes as Kategori', 'Kategori.code_cd', '=', 'lilas.kategori_tp', 'left')
            ->join('com_regions as Desa', 'Desa.region_cd', '=', 'lilas.desa', 'left')
            ->join('com_regions as Kecamatan', 'Kecamatan.region_cd', '=', 'lilas.kecamatan', 'left')
            ->select('lilas.nama', 'lilas.lila', 'Usia.code_nm as Usia', 'Kategori.code_nm As Kategori', 'lilas.nik', 'Desa.region_nm AS Desa', 'Kecamatan.region_nm AS Kecamatan', 'lilas.alamat', 'sekolahs.nama as Sekolah')->get();

        // dd($data);
        return Excel::download(new LilaExport($data), 'coba.csv');
    }

    public function mount()
    {
        $this->region_kec = ComRegion::where('region_level', '3')->get();
        $this->sekolah = Sekolah::get();
    }

    public function render()
    {
        return view('livewire.admin.pages.data-lila.lila', [
            'data' => ModelsLila::where('nama', 'like', '%' . $this->nama . '%')->where('nik', 'like', '%' . $this->nik . '%')->where('desa', 'like', '%' . $this->desa . '%')->where('usia_tp', 'like', '%' .  $this->usia_tp . '%')->where('kategori_tp', 'like', '%' .  $this->kategori_tp . '%')->orderBy('id', 'DESC')->paginate(20),
        ]);
    }
}
