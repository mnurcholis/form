<?php

namespace App\Livewire\Admin\Pages\Data;

use App\Exports\LilaExport;
use App\Models\ComRegion;
use App\Models\Lila as ModelsLila;
use App\Models\Sekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class FormGarageShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $region_kec, $region_kel, $sekolah, $sekolah_id, $kecamatan, $desa, $usia_tp, $kategori_tp, $nama, $nik;

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

    public function updateFormUsia()
    {
    }

    public function exportData()
    {
        $data = DB::table('lilas')
            ->leftJoin('sekolahs', 'sekolahs.id', '=', 'lilas.sekolah_id')
            ->leftJoin('com_codes as Usia', 'Usia.code_cd', '=', 'lilas.usia_tp')
            ->leftJoin('com_codes as Kategori', 'Kategori.code_cd', '=', 'lilas.kategori_tp')
            ->leftJoin('com_regions as Desa', 'Desa.region_cd', '=', 'lilas.desa')
            ->leftJoin('com_regions as Kecamatan', 'Kecamatan.region_cd', '=', 'lilas.kecamatan')
            ->select(
                'lilas.nama',
                'lilas.nik',
                'Kecamatan.region_nm AS Kecamatan',
                'Desa.region_nm AS Desa',
                'lilas.alamat',
                'sekolahs.nama as Sekolah',
                'Kategori.code_nm As Kategori',
                'Usia.code_nm as Usia',
                'lilas.lila',
                DB::raw("CASE WHEN lilas.lila <= Usia.code_value THEN 'kek' ELSE 'tidak kek' END AS ConditionResult")
            );

        $namefile = '';

        if ($this->nama) {
            $data->where('nama', 'like', '%' . $this->nama . '%');
        }
        if ($this->nik) {
            $data->where('nik', 'like', '%' . $this->nik . '%');
        }
        if ($this->kecamatan) {
            $data->where('kecamatan', 'like', '%' . $this->kecamatan . '%');
            $namefile .= ComRegion::where('region_cd', $this->kecamatan)->first()->region_nm . '_';
        }
        if ($this->desa) {
            $data->where('desa', 'like', '%' . $this->desa . '%');
            $namefile .= ComRegion::where('region_cd', $this->desa)->first()->region_nm . '_';
        }
        if ($this->usia_tp) {
            $data->where('usia_tp', 'like', '%' .  $this->usia_tp . '%');
        }
        if ($this->kategori_tp) {
            $data->where('kategori_tp', 'like', '%' .  $this->kategori_tp . '%');
        }
        if ($this->sekolah_id) {
            $data->where('sekolah_id', 'like', '%' .  $this->sekolah_id . '%');
            $namefile .= Sekolah::where('id', $this->sekolah_id)->first()->nama . '_';
        }

        $results = $data->get();

        // Counting the occurrences of 'tidak kek' and 'kek'
        $Count = collect($results)->count();
        $tidakKekCount = collect($results)->where('ConditionResult', 'tidak kek')->count();
        $kekCount = collect($results)->where('ConditionResult', 'kek')->count();

        // Adding counts to the $results array
        $results['jumlah_data'] = null;
        $results['jumlah_data'] = 'Jumlah Data : ' . $Count;
        $results['jumlah_tidak_kek'] = 'Jumlah Tidak Kek : ' . $tidakKekCount;
        $results['jumlah_kek'] = 'Jumlah Kek : ' . $kekCount;

        if ($data->count() == 0) {
            Session::flash('success', 'Data Berhasil disimpan');
            return 0;
        }

        $results = $results->map(function ($row) {
            return is_array($row) ? $row : (array)$row;
        });

        // dd($data);
        // return Excel::download(new LilaExport($results), 'data.csv');
        return Excel::download(new LilaExport($results), 'Data_lila_' . $namefile . time() . '.xlsx');
    }

    public function mount()
    {
        $this->region_kec = ComRegion::where('region_level', '3')->get();
        $this->sekolah = Sekolah::get();
    }

    public function render()
    {
        $query = DB::table('lilas')
            ->leftJoin('sekolahs', 'sekolahs.id', '=', 'lilas.sekolah_id')
            ->leftJoin('com_codes as Usia', 'Usia.code_cd', '=', 'lilas.usia_tp')
            ->leftJoin('com_codes as Kategori', 'Kategori.code_cd', '=', 'lilas.kategori_tp')
            ->leftJoin('com_regions as Desa', 'Desa.region_cd', '=', 'lilas.desa')
            ->leftJoin('com_regions as Kecamatan', 'Kecamatan.region_cd', '=', 'lilas.kecamatan')
            ->select(
                'lilas.id',
                'lilas.nama',
                'lilas.nik',
                'Kecamatan.region_nm AS Kecamatan',
                'Desa.region_nm AS Desa',
                'lilas.alamat',
                'sekolahs.nama as Sekolah',
                'Kategori.code_nm As Kategori',
                'Usia.code_nm as Usia',
                'lilas.lila',
                DB::raw("CASE WHEN lilas.lila < Usia.code_value THEN 'kek' ELSE 'tidak kek' END AS ConditionResult")
            );
        if ($this->nama) {
            $query->where('nama', 'like', '%' . $this->nama . '%');
        }
        if ($this->nik) {
            $query->where('nik', 'like', '%' . $this->nik . '%');
        }
        if ($this->kecamatan) {
            $query->where('kecamatan', 'like', '%' . $this->kecamatan . '%');
        }
        if ($this->desa) {
            $query->where('desa', 'like', '%' . $this->desa . '%');
        }
        if ($this->usia_tp) {
            $query->where('usia_tp', 'like', '%' .  $this->usia_tp . '%');
        }
        if ($this->kategori_tp) {
            $query->where('kategori_tp', 'like', '%' .  $this->kategori_tp . '%');
        }
        if ($this->sekolah_id) {
            $query->where('sekolah_id', 'like', '%' .  $this->sekolah_id . '%');;
        }
        $coba = $query->get();;
        $query = $query->orderBy('lilas.id', 'DESC')->paginate(20);

        return view('livewire.admin.pages.data.form-garage-show', [
            'data' => $query,
            'coba' => $coba,
        ]);
    }
}
