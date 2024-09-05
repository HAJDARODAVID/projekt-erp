<?php

namespace App\Livewire\HidroProjekt\Costs;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BillCategoryModel;
use Livewire\Attributes\On; 

class BillCategoriesTable extends DataTableComponent
{
    protected $model = BillCategoryModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Kategorija", "category")
                ->sortable(),
        ];
    }

    #[On('refresh-bill-categories-table')] 
    public function refreshMe(){
        return;
    }
}
