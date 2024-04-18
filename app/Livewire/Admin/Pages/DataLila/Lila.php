<?php

namespace App\Livewire\Admin\Pages\DataLila;

use App\Models\ComRegion;
use App\Models\Lila as ModelsLila;
use App\Models\Sekolah;
use Livewire\Component;
use Livewire\WithPagination;

class Lila extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $region_kec, $region_kel, $sekolah, $kecamatan, $desa;

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

    public function mount()
    {
        $this->region_kec = ComRegion::where('region_level', '3')->get();
        $this->sekolah = Sekolah::get();
    }

    public function render()
    {
        return view('livewire.admin.pages.data-lila.lila', [
            'data' => ModelsLila::where('desa', 'like', '%' . $this->desa . '%')->orderBy('id', 'DESC')->paginate(2),
        ]);
    }
}
