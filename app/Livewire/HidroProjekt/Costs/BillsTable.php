<?php

namespace App\Livewire\HidroProjekt\Costs;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BillModel;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On; 

class BillsTable extends DataTableComponent
{
    protected $model = BillModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchBlur();
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->hideIf(TRUE),
            Column::make("Poslužitelj", "getProvider.provider")
                ->sortable()
                ->searchable(),
            Column::make("Kategorija", "getCategory.category")
                ->sortable()
                ->searchable(),
            Column::make("Iznos[€]", "amount")
                ->sortable(),
            Column::make("Datum", "date")
                ->sortable(),
            Column::make("Napomena", "remark")
                ->sortable(),
        ];
    }

    public function builder(): Builder{
        return BillModel::query()->orderBy('id', 'desc');
    }

    #[On('refresh-bills-table')] 
    public function refreshMe(){
        return;
    }
}
