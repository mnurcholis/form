<?php

namespace App\Livewire\Admin\Pages\DataLila;

use App\Models\ComCode;
use App\Models\ComRegion;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Lila;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TableLila extends DataTableComponent
{
    protected $model = Lila::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFiltersEnabled();
    }

    // public function filters(): array
    // {
    //     return [
    //         SelectFilter::make('Desa')
    //             ->options([
    //                 '' => 'All',
    //             ]),
    //     ];
    // }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama", "Nama")
                ->sortable(),
            Column::make("NIK", "nik")
                ->sortable(),
            Column::make("Desa", "desa")
                ->sortable()->format(function ($value, $column, $row) {
                    return ComRegion::where('region_cd', $value)->first()->region_nm;
                }),
            Column::make("Usia TP", "usia_tp")
                ->sortable()->format(function ($value, $column, $row) {
                    return ComCode::where('code_cd', $value)->first()->code_nm;
                }),
            Column::make("Kategori", "kategori_tp")
                ->sortable()->format(function ($value, $column, $row) {
                    if ($value) {
                        return ComCode::where('code_cd', $value)->first()->code_nm;
                    }
                }),
            Column::make("Kecamatan", "Kecamatan.region_nm")
                ->sortable(),
            Column::make("Alamat", "alamat")
                ->sortable(),
            Column::make("Sekolah", "Sekolah.nama")
                ->sortable(),
            Column::make("LILA", "lila")
                ->sortable(),
        ];
    }
}
