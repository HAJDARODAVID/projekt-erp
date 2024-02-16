<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\AppParametersModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class AppParamsTable extends DataTableComponent
{
    protected $model = AppParametersModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setLoadingPlaceholderStatus(true);
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->hideIf(Auth::user()->type != User::USER_TYPE_SUPER_ADMIN),
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
            ->where('active', TRUE)
            ->orderBy('param_name', 'asc');
    }
}
