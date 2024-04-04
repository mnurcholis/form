<?php

namespace App\Livewire\Admin\Form;

use App\Models\ComRegion;
use App\Models\Lila;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PengukuranLila extends Component
{
    public $region_kec, $region_kel;

    public $form = [
        'kecamatan' => '',
        'desa' => '',
        'nama' => '',
        'usia_tp' => '',
        'alamat' => '',
        'kategori_tp' => '',
        'lila' => '',
        'kek' => ''
    ];

    public function updateFormKecamatan()
    {
        $this->region_kel = ComRegion::where('region_root', $this->form['kecamatan'])->get()->toArray();
    }

    public function simpan()
    {
        $this->validate([
            'form.nama' => 'required',
            'form.lila' => 'required|numeric|min:1',
            'form.kecamatan' => 'required',
            'form.desa' => 'required',
        ]);
        Lila::create($this->form);
        $this->form =  [
            'kecamatan' => '',
            'desa' => '',
            'nama' => '',
            'usia_tp' => '',
            'alamat' => '',
            'kategori_tp' => '',
            'lila' => '',
            'kek' => ''
        ];
        $this->region_kel = [];
        Session::flash('success', 'Data Berhasil disimpan');
    }

    public function mount()
    {
        $this->region_kec = ComRegion::where('region_level', '3')->get();
    }

    public function render()
    {
        return view('livewire.admin.form.pengukuran-lila')->layout('form.app');
    }
}
