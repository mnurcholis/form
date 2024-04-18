<?php

namespace App\Livewire\Admin\Pages\DataSekolah;

use App\Models\Sekolah;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class DataSekolah extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $idNya, $nama, $isOpen =  false, $sekolah = [
        'nsm' => null,
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
        $data = Sekolah::find($id);
        $this->sekolah = [
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
            Sekolah::create($this->sekolah);
        }
        Session::flash('success', 'Data Berhasil disimpan');
        $this->cancel();
    }

    public function update()
    {
        Sekolah::find($this->idNya)->update($this->sekolah);
        Session::flash('success', 'Data Berhasil disimpan');
        $this->cancel();
    }

    public function render()
    {
        return view('livewire.admin.pages.data-sekolah.data-sekolah', [
            'data' => Sekolah::where('nama', 'like', '%' . $this->nama . '%')->orderBy('id', 'DESC')->paginate(10),
        ]);
    }
}
