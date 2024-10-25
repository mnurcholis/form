<?php

namespace App\Livewire\Admin\Pages\TPS;

use App\Models\ComRegion;
use App\Models\Hasil;
use Livewire\Component;
use Livewire\WithPagination;

class InputTPS extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $idNya, $limit = 10;
    public $g_1 = [];
    public $g_2 = [];
    public $g_3 = [];
    public $b_1 = [];
    public $b_2 = [];
    public $b_3 = [];
    public $listKec, $listDesa, $searchKecamatan, $searchDesa;

    public function clear()
    {
        $this->searchKecamatan = null;
        $this->searchDesa = null;
        $this->searchDesa = null;
        $this->listDesa = null;
    }
    public function updatedSearchKecamatan()
    {
        $this->listDesa = ComRegion::where('region_root', $this->searchKecamatan)->get()->toArray();
        $this->searchDesa = null;
    }
    public function edit($id = '')
    {
        $this->idNya = $id;
    }
    public function save($index,  $id)
    {


        // Find the row by its ID
        $row = Hasil::find($id);

        // Update the fields only if the row exists
        if ($row) {
            $row->g_1 = $this->g_1[$index] ?? 0;
            $row->g_2 = $this->g_2[$index] ?? 0;
            $row->g_3 = $this->g_3[$index] ?? 0;
            $row->b_1 = $this->b_1[$index] ?? 0;
            $row->b_2 = $this->b_2[$index] ?? 0;
            $row->b_3 = $this->b_3[$index] ?? 0;

            // Save the updated row
            $row->save();
        }

        $this->idNya = null;
    }
    public function mount()
    {
        $this->listKec = ComRegion::where('region_level', '3')->get();
    }
    public function render()
    {
        $data = Hasil::query();
        if (auth()->user()->region_cd) {
            $data->whereHas('kecamatanTPS', function ($query) {
                $query->where('region_cd', auth()->user()->region_cd);
            });
        }
        if ($this->searchKecamatan) {
            $data->whereHas('kecamatanTPS', function ($query) {
                $query->where('region_cd', $this->searchKecamatan);
            });
        }
        if ($this->searchDesa) {
            $data->whereHas('desaTPS', function ($query) {
                $query->where('region_cd', $this->searchDesa);
            });
        }
        $data = $data->with(['kecamatanTPS', 'desaTPS'])->orderBy('kecamatan', 'ASC')->paginate($this->limit);
        $this->g_1 = [];
        $this->g_2 = [];
        $this->g_3 = [];
        $this->b_1 = [];
        $this->b_2 = [];
        $this->b_3 = [];

        foreach ($data as $datum) {
            array_push($this->g_1, $datum->g_1);
            array_push($this->g_2, $datum->g_2);
            array_push($this->g_3, $datum->g_3);
            array_push($this->b_1, $datum->b_1);
            array_push($this->b_2, $datum->b_2);
            array_push($this->b_3, $datum->b_3);
        }
        return view('livewire.admin.pages.t-p-s.input-t-p-s', ['data' => $data]);
    }
}
