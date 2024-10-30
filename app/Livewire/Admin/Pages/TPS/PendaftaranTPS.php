<?php

namespace App\Livewire\Admin\Pages\TPS;

use App\Imports\HasilImport;
use App\Models\ComRegion;
use App\Models\Hasil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PendaftaranTPS extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $form, $idNya;
    public $region_kec, $region_kel, $desa, $kecamatan, $tps, $file, $searchKecamatan, $searchDesa;
    public $listKec, $listDesa;
    public $progress = 0;
    public function updatedFile()
    {
        $this->reset('progress');
    }
    public function setProgress($progress)
    {

        $this->progress =  $this->stream(
            to: 'progress',
            content: '<progress style="width=100%" max="100" value="' . $progress . '"></progress><p>' . round($progress) . '%</p>',
            replace: true
        );
    }
    public function updatedSearchKecamatan()
    {
        $this->listDesa = ComRegion::where('region_root', $this->searchKecamatan)->get()->toArray();
        $this->searchDesa = null;
    }
    public function updateFormKecamatan()
    {
        $this->region_kel = ComRegion::where('region_root', $this->kecamatan)->get()->toArray();
        $this->desa = null;
    }
    public function importTps()
    {
        $valid = [
            'file' => 'required|mimes:xlsx,csv,xls',
        ];
        $messages = [
            'file.required' => 'Wajib Diisi',
            'file.mimes' => 'File Extensi .xlsx, .csv, .xls'
        ];

        $this->validate($valid, $messages);
        DB::table('hasils')->truncate();
        $import = new HasilImport($this);
        Excel::import($import, $this->file->getRealPath());

        $errors = $import->getErrors();
        $html = '';
        foreach ($errors as $item) {
            $html = $html . '<tr><td>' . $item . '</td></tr>';
        }

        $errorMessages = implode("\n", $errors);
        $e = json_encode($errorMessages);

        if ($errors) {
            // $this->js(<<<JS
            //     Swal.fire({
            //         position: "top-end",
            //         icon: "error",
            //         title: "There were errors during the import",
            //         html: $e,
            //         showConfirmButton: true,
            //         confirmButtonText: "OK"
            //     });
            // JS);
        } else {
            $this->dispatchBrowserEvent('close-import-tps');
        }
        $this->file = null;
    }
    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-import-tps');
    }
    public function toModalImport()
    {
        $this->dispatchBrowserEvent('import-tps');
    }
    public function tambah($id = '')
    {
        $this->form = true;
        if ($id) {
            $data = Hasil::find($id);
            $this->idNya = $data->id;
            $this->kecamatan = $data->kecamatan;
            $this->region_kec = ComRegion::where('region_root', $this->kecamatan)->get()->toArray();
            $this->desa = $data->desa;
            $this->region_kel = ComRegion::where('region_root', $this->desa)->get()->toArray();
            $this->tps = $data->tps;
        } else {
            $this->clear();
        }
    }
    public function cancel()
    {
        $this->form = true;
        $this->clear();
    }
    public function simpan()
    {
        if ($this->idNya) {
        } else {
            Hasil::create([
                'kecamatan' => $this->kecamatan,
                'desa' => $this->desa,
                'tps' => $this->tps
            ]);
            Session::flash('success', 'Data Berhasil disimpan');
            $this->form = false;
        }
    }
    public function clear()
    {
        $this->kecamatan = null;
        $this->desa = null;
        $this->tps = null;
        $this->file = null;
        $this->idNya = null;
        $this->searchKecamatan = null;
        $this->searchDesa = null;
    }
    public function mount()
    {
        $this->region_kec = ComRegion::where('region_level', '3')->get();
        $this->listKec = ComRegion::where('region_level', '3')->get();
    }
    public function render()
    {
        $data = Hasil::query();
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
        $data = $data->with(['kecamatanTPS', 'desaTPS'])->paginate(20);
        return view('livewire.admin.pages.t-p-s.pendaftaran-t-p-s', ['data' => $data]);
    }
}
