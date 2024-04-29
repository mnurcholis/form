<?php

namespace App\Livewire\Admin\Form;

use App\Models\ComRegion;
use App\Models\Lila;
use App\Models\Sekolah;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PengukuranLila extends Component
{
    public $region_kec, $region_kel, $sekolah;

    public $form = [
        'kecamatan' => '',
        'desa' => '',
        'nama' => '',
        'nik' => '',
        'usia_tp' => '',
        'alamat' => '',
        'sekolah_id' => '',
        'kategori_tp' => '',
        'lila' => '',
        'kek' => '1'
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
            'form.usia_tp' => 'required',
            'form.kategori_tp' => 'required',
        ]);
        Lila::create($this->form);
        $this->form =  [
            'kecamatan' => '',
            'desa' => '',
            'nama' => '',
            'nik' => '',
            'usia_tp' => '',
            'alamat' => '',
            'sekolah_id' => '',
            'kategori_tp' => '',
            'lila' => '',
            'kek' => '1'
        ];
        $this->region_kel = [];
        Session::flash('success', 'Data Berhasil disimpan');
        $this->dispatchBrowserEvent('kosong_sekolah');
    }

    public function mount()
    {
        $this->region_kec = ComRegion::where('region_level', '3')->get();
        $this->sekolah = Sekolah::get();
    }

    public function render()
    {
        return view('livewire.admin.form.pengukuran-lila')->layout('form.app');
    }
}
