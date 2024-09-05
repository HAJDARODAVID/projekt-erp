<?php

namespace App\Livewire\HidroProjekt\Costs;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BillProviderModel;
use Livewire\Attributes\On; 

class BillProvidersTable extends DataTableComponent
{
    protected $model = BillProviderModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchBlur();
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Poslužitelj", "provider")
                ->sortable()
                ->searchable(),
        ];
    }

    #[On('refresh-bill-provider-table')] 
    public function refreshMe(){
        return;
    }
}
