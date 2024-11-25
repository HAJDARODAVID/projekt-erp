<?php

namespace App\Livewire\HidroProjekt\Sales;

use App\Models\StorageStockItem;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Views\AvailableMaterialView;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class AvailableMaterialsTable extends DataTableComponent
{
    //protected $model = StorageStockItem::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->hideIf(TRUE),
            Column::make("#", "mat_id")
                ->searchable(),
            Column::make("Materijal", "name")
                ->searchable(),
            Column::make("Kol.", "qty"),
            Column::make('','id')
                ->view('hidro-projekt.SALES.availableMaterialsTableActionBtn'),
        ];
    }

    public function builder(): Builder{
        return AvailableMaterialView::query()
            ->orderBy('name', 'asc');
    }
}
