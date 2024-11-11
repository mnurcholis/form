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
    public $g_ts = [];
    public $b_1 = [];
    public $b_2 = [];
    public $b_ts = [];
    public $dpt = [];
    public $dptb = [];
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
    private function defaultZero($value)
    {
        return $value === '' ? 0 : $value;
    }
    public function save($index,  $id)
    {
        $this->g_1[$index] = $this->defaultZero($this->g_1[$index]);
        $this->g_2[$index] = $this->defaultZero($this->g_2[$index]);
        $this->g_ts[$index] = $this->defaultZero($this->g_ts[$index]);
        $this->b_1[$index] = $this->defaultZero($this->b_1[$index]);
        $this->b_2[$index] = $this->defaultZero($this->b_2[$index]);
        $this->b_ts[$index] = $this->defaultZero($this->b_ts[$index]);
        $this->dpt[$index] = $this->defaultZero($this->dpt[$index]);
        $this->dptb[$index] = $this->defaultZero($this->dptb[$index]);

        $row = Hasil::find($id);
        if ($row) {
            $row->g_1 = $this->g_1[$index];
            $row->g_2 = $this->g_2[$index];
            $row->g_ts = $this->g_ts[$index];
            $row->b_1 = $this->b_1[$index];
            $row->b_2 = $this->b_2[$index];
            $row->b_ts = $this->b_ts[$index];
            $row->dpt = $this->dpt[$index];
            $row->dptb = $this->dptb[$index];
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
        $data = $data->with(['kecamatanTPS', 'desaTPS'])->orderBy('kecamatan', 'ASC')->orderBy('desa', 'ASC')->paginate($this->limit);
        $this->g_1 = [];
        $this->g_2 = [];
        $this->g_ts = [];
        $this->b_1 = [];
        $this->b_2 = [];
        $this->b_ts = [];
        $this->dpt = [];
        $this->dptb = [];

        foreach ($data as $datum) {
            array_push($this->g_1, $datum->g_1);
            array_push($this->g_2, $datum->g_2);
            array_push($this->g_ts, $datum->g_ts);
            array_push($this->b_1, $datum->b_1);
            array_push($this->b_2, $datum->b_2);
            array_push($this->b_ts, $datum->b_ts);
            array_push($this->dpt, $datum->dpt);
            array_push($this->dptb, $datum->dptb);
        }
        return view('livewire.admin.pages.t-p-s.input-t-p-s', ['data' => $data]);
    }
}
