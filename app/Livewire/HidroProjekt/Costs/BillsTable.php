<?php

namespace App\Livewire\HidroProjekt\Costs;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BillModel;

class BillsTable extends DataTableComponent
{
    protected $model = BillModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Provider id", "provider_id")
                ->sortable(),
            Column::make("Categories id", "categories_id")
                ->sortable(),
            Column::make("Amount", "amount")
                ->sortable(),
            Column::make("Date", "date")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
