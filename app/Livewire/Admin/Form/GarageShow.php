<?php

namespace App\Livewire\Admin\Form;

use App\Models\Lila;
use App\Models\ComCode;
use App\Models\Sekolah;
use Livewire\Component;
use App\Models\ComRegion;
use App\Models\SekolahOrg;
use App\Models\FormGarageShow;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class GarageShow extends Component
{
    public $listType, $tampil = true, $type;

    public $form = [
        'type' => '',
        'sekolahorg_id' => '',
        'nama' => '',
        'no_handphone' => '',
        'email' => '',
        'no_tiket' => '',
        'path_no_tiket' => '',
    ];

    public function UpdateType()
    {
        $this->listType = SekolahOrg::where('type', $this->form['type'])->get()->toArray();
        $this->form['sekolahorg_id'] = null;
    }

    public function simpan()
    {
        $this->validate([
            // 'form.type' => 'required',
            // 'form.sekolahorg_id' => 'required',
            'form.nama' => 'required',
            'form.no_handphone' => 'required|unique:form_garage_shows,no_handphone',
            'form.email' => 'required|email|unique:form_garage_shows,email',
        ]);
        FormGarageShow::create($this->form);
        $this->form = [
            'type' => '',
            'sekolahorg_id' => '',
            'nama' => '',
            'no_handphone' => '',
            'email' => '',
            'no_tiket' => gen_no_tiket(),
            'path_no_tiket' => Crypt::encryptString(gen_no_tiket()),
        ];

        $this->listType = [];
        Session::flash('success', 'Terimakasih telah melakukan registrasi, tim kami akan mengirimkan bukti registrasi melalui WhatsApp Wonosobo Hebat');
    }

    public function mount()
    {
        $this->type = ComCode::where('code_group', 'JENIS_SO')->get();
        $this->form['no_tiket'] = gen_no_tiket();
        $this->form['path_no_tiket'] = Crypt::encryptString(gen_no_tiket());
    }

    public function render()
    {
        return view('livewire.admin.form.garage-show')->layout('form.app');
    }
}
