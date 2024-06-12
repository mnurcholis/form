<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Sekolah;
use App\Models\SekolahOrg;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class DataSekolahOrganisasi extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $idNya, $nama, $isOpen =  false, $sekolah = [
        'nsm' => null,
        'type' => null,
        'npsm' => null,
        'nama' => null,
        'alamat' => null,
    ];

    public function updatingNama()
    {
        $this->resetPage();
    }

    public function Edit($id)
    {
        $this->isOpen = true;
        $this->idNya = $id;
        $data = SekolahOrg::find($id);
        $this->sekolah = [
            'type' => $data->type,
            'nsm' => $data->nsm,
            'npsm' => $data->npsm,
            'nama' => $data->nama,
            'alamat' => $data->alamat,
        ];
    }

    public function create()
    {
        $this->isOpen =  true;
        $this->sekolah = [
            'type' => null,
            'nsm' => null,
            'npsm' => null,
            'nama' => null,
            'alamat' => null,
        ];
    }

    public function cancel()
    {
        $this->isOpen =  false;
        $this->sekolah = [
            'type' => null,
            'nsm' => null,
            'npsm' => null,
            'nama' => null,
            'alamat' => null,
        ];
        $this->idNya =  null;
    }

    public function simpan()
    {
        if ($this->idNya) {
            $this->update();
        } else {
            SekolahOrg::create($this->sekolah);
        }
        Session::flash('success', 'Data Berhasil disimpan');
        $this->cancel();
    }

    public function update()
    {
        SekolahOrg::find($this->idNya)->update($this->sekolah);
        Session::flash('success', 'Data Berhasil disimpan');
        $this->cancel();
    }

    public function render()
    {
        return view('livewire.admin.pages.data-sekolah-organisasi', [
            'data' => SekolahOrg::where('nama', 'like', '%' . $this->nama . '%')->orderBy('id', 'DESC')->paginate(10),
        ]);
    }
}
