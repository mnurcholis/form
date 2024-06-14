<?php

namespace App\Livewire\Admin\Pages\Data;

use App\Exports\GarageShowExport;
use App\Exports\LilaExport;
use App\Models\ComRegion;
use App\Models\FormGarageShow as ModelsFormGarageShow;
use App\Models\Lila as ModelsLila;
use App\Models\Sekolah;
use App\Models\SekolahOrg;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class FormGarageShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nama, $no_handphone, $email, $type, $listType, $sekolahorg_id, $idNya;

    public function exportData()
    {
        $data = DB::table('form_garage_shows')
            ->leftJoin('sekolah_orgs', 'sekolah_orgs.id', '=', 'form_garage_shows.sekolahorg_id')
            ->leftJoin('com_codes as Type', 'Type.code_cd', '=', 'form_garage_shows.type')
            ->select(
                'Type.code_nm',
                'sekolah_orgs.nama as so_nama',
                'form_garage_shows.nama',
                'form_garage_shows.no_handphone',
                'form_garage_shows.email',
            );


        $namefile = '';

        if ($this->nama) {
            $data->where('form_garage_shows.nama', 'like', '%' . $this->nama . '%');
        }
        if ($this->sekolahorg_id) {
            $data->where('form_garage_shows.sekolahorg_id', $this->sekolahorg_id);
        }

        $results = $data->get();

        if ($data->count() == 0) {
            Session::flash('success', 'Data Berhasil disimpan');
            return 0;
        }

        $results = $results->map(function ($row) {
            return is_array($row) ? $row : (array)$row;
        });

        // dd($data);
        // return Excel::download(new LilaExport($results), 'data.csv');
        return Excel::download(new GarageShowExport($results), 'Data_' . $namefile . time() . '.xlsx');
    }

    public function UpdateType()
    {
        $this->listType = SekolahOrg::where('type', $this->type)->get()->toArray();
        $this->sekolahorg_id = null;
    }

    public function confirmDelete($id)
    {
        $this->idNya = $id;
        $this->dispatchBrowserEvent('confirmDelete');
    }

    public function Delete()
    {
        ModelsFormGarageShow::destroy($this->idNya);
        $this->idNya = NULL;
    }

    public function mount()
    {
    }

    public function render()
    {
        $query = DB::table('form_garage_shows')
            ->leftJoin('sekolah_orgs', 'sekolah_orgs.id', '=', 'form_garage_shows.sekolahorg_id')
            ->leftJoin('com_codes as Type', 'Type.code_cd', '=', 'form_garage_shows.type')
            ->select(
                'sekolah_orgs.nama as so_nama',
                'Type.code_nm',
                'form_garage_shows.id',
                'form_garage_shows.nama',
                'form_garage_shows.no_handphone',
                'form_garage_shows.email',
            );
        if ($this->nama) {
            $query->where('form_garage_shows.nama', 'like', '%' . $this->nama . '%');
        }
        if ($this->sekolahorg_id) {
            $query->where('form_garage_shows.sekolahorg_id', $this->sekolahorg_id);
        }
        $coba = $query->get();;
        $query = $query->orderBy('form_garage_shows.id', 'DESC')->paginate(20);

        return view('livewire.admin.pages.data.form-garage-show', [
            'data' => $query,
            'coba' => $coba,
        ]);
    }
}
