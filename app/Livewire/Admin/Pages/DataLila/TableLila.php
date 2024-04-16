<?php

namespace App\Livewire\Admin\Pages\DataLila;

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
        ];
    }
}
