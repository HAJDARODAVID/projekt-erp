<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\CooperatorsModel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CooperatorTable extends DataTableComponent
{
    protected $model = CooperatorsModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('hp_showCooperators', $row->id);
        });
        $this->setFilter('status', '1');
        $this->setSearchBlur();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Naziv kooperanta", "name")
                ->searchable(),
        ];
    }

    public function filters(): array{
        return [
            SelectFilter::make('Status', 'status')
                ->options(CooperatorsModel::COOPERATORS_STATUS)
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('status', $value);
                }),
    
            ];
        }
}
