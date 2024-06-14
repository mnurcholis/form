<?php

namespace App\Livewire\Admin\Pages\Pendaftaran;

use App\Models\FormGarageShow;
use App\Models\Sekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Pendaftaran extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $no_tiket;

    public function simpan()
    {
        $this->validate([
            'no_tiket' => 'required',
        ]);
        $data = FormGarageShow::where('no_tiket', $this->no_tiket)->first();
        $data->status_hadir = 1;
        $data->save();
        $this->no_tiket = null;
        Session::flash('success', 'Berhasil Konfirmasi Kehadiran');
    }

    public function render()
    {
        $data = DB::table('form_garage_shows')
            ->leftJoin('sekolah_orgs', 'sekolah_orgs.id', '=', 'form_garage_shows.sekolahorg_id')
            ->leftJoin('com_codes as Type', 'Type.code_cd', '=', 'form_garage_shows.type')
            ->select(
                'sekolah_orgs.nama as so_nama',
                'Type.code_nm',
                'form_garage_shows.id',
                'form_garage_shows.nama',
                'form_garage_shows.no_handphone',
                'form_garage_shows.email',
                'form_garage_shows.updated_at',
            )
            ->where('status_hadir', 1);

        $coba = $data->get();
        $data = $data->orderBy('form_garage_shows.id', 'DESC')->paginate(20);
        return view('livewire.admin.pages.pendaftaran.pendaftaran', [
            'coba' => $coba,
            'data' => $data,
        ]);
    }
}
