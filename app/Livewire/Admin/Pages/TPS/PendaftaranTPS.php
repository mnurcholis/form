<?php

namespace App\Livewire\Admin\Pages\TPS;

use App\Models\ComRegion;
use App\Models\Hasil;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class PendaftaranTPS extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $form, $idNya;
    public $region_kec, $region_kel, $desa, $kecamatan, $tps;
    public function updateFormKecamatan()
    {
        $this->region_kel = ComRegion::where('region_root', $this->kecamatan)->get()->toArray();
        $this->desa = null;
    }
    public function tambah($id = '')
    {
        $this->form = true;
        if ($id) {
            $data = Hasil::find($id);
            $this->idNya = $data->id;
            $this->kecamatan = $data->kecamatan;
            $this->region_kec = ComRegion::where('region_root', $this->kecamatan)->get()->toArray();
            $this->desa = $data->desa;
            $this->region_kel = ComRegion::where('region_root', $this->desa)->get()->toArray();
            $this->tps = $data->tps;
        } else {
            $this->clear();
        }
    }
    public function cancel()
    {
        $this->form = true;
        $this->clear();
    }
    public function simpan()
    {
        if ($this->idNya) {
        } else {
            Hasil::create([
                'kecamatan' => $this->kecamatan,
                'desa' => $this->desa,
                'tps' => $this->tps
            ]);
            Session::flash('success', 'Data Berhasil disimpan');
            $this->form = false;
        }
    }
    public function clear()
    {
        $this->kecamatan = null;
        $this->desa = null;
        $this->tps = null;
        $this->idNya = null;
    }
    public function mount()
    {
        $this->region_kec = ComRegion::where('region_level', '3')->get();
    }
    public function render()
    {
        $data = Hasil::query();
        $data = $data->with(['kecamatanTPS', 'desaTPS'])->orderBy('kecamatan', 'ASC')->paginate(20);
        return view('livewire.admin.pages.t-p-s.pendaftaran-t-p-s', ['data' => $data]);
    }
}
