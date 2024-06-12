<?php

namespace App\Livewire\Admin\Form;

use App\Models\ComRegion;
use App\Models\FormGarageShow;
use App\Models\Lila;
use App\Models\Sekolah;
use App\Models\SekolahOrg;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class GarageShow extends Component
{
    public $listType, $tampil = true;

    public $form = [
        'type' => '',
        'sekolahorg_id' => '',
        'nama' => '',
        'no_handphone' => '',
        'email' => '',
    ];

    public function UpdateType()
    {
        $this->listType = SekolahOrg::where('type', $this->form['type'])->get()->toArray();
        $this->form['sekolahorg_id'] = null;
    }

    public function simpan()
    {
        $this->validate([
            'form.type' => 'required',
            'form.sekolahorg_id' => 'required',
            'form.nama' => 'required',
            'form.no_handphone' => 'required',
            'form.email' => 'required',
        ]);
        FormGarageShow::create($this->form);
        $this->form =  [
            'type' => '',
            'sekolahorg_id' => '',
            'nama' => '',
            'no_handphone' => '',
            'email' => '',
        ];
        $this->listType = [];
        Session::flash('success', 'Terimakasih telah melakukan registrasi, tim kami akan mengirimkan bukti registrasi melalui WhatsApp Wonosobo Hebat');
    }

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.admin.form.garage-show')->layout('form.app');
    }
}
