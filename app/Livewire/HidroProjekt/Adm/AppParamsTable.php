<?php

namespace App\Livewire\HidroProjekt\Adm;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AppParametersModel;
use Illuminate\Database\Eloquent\Builder;

class AppParamsTable extends DataTableComponent
{
    protected $model = AppParametersModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Naziv parametra", "param_name")
                ->sortable(),
            Column::make("Alias", "param_name_srt")
                ->sortable(),
            Column::make('Vrijednost')
                ->label(
                    fn($row, Column $column) => view('components.adm.change-param-value')->withRow($row)
                ),

            Column::make("Active", "active")
                ->hideIf(true),
            Column::make("Vrijednost", "value")
                ->hideIf(true),
        ];
    }

    public function builder(): Builder{
        return AppParametersModel::query()
            ->where('active', TRUE);
    }
}
