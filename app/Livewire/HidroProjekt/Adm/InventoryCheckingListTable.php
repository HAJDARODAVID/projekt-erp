<?php

namespace App\Livewire\HidroProjekt\Adm;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InventoryCheckingItem;
use App\Models\User;
use Livewire\Attributes\On; 

class InventoryCheckingListTable extends DataTableComponent
{
    public $invId;
    protected $model = InventoryCheckingItem::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(TRUE),
            Column::make("Inv id", "inv_id")
                ->hideIf(TRUE),
            Column::make("user_id", "user_id")
                ->hideIf(TRUE),
            Column::make("Qty", "qty")
                ->hideIf(TRUE),
            Column::make("#Mat", "mat_id")
                ->sortable()
                ->searchable(),
            Column::make("Material", "getMaterialInfo.name")
                ->sortable()
                ->searchable(),
            Column::make("Korisnik")
                ->label(
                    fn($row, Column $column) => $this->getUserFullName($row)
                ),
            Column::make("Lokacija", "str_loc")
                ->sortable(),
            Column::make("Gradilište", "getConstructionSiteInfo.name")
                ->sortable(),
            Column::make("Qty")
                ->label(
                    fn($row) => $this->getInputBoxForQty($row)
                )->html(),
            Column::make("Kreirano", "created_at")
                ->sortable(),
        ];
    }

    public function builder(): Builder{
        return InventoryCheckingItem::query()
            ->where('inv_id', $this->invId)
            ->orderBy('created_at', 'desc');
    }

    private function getUserFullName($row){
        $user = User::where('id', $row->user_id)->with('getWorker')->first();
        $fullName = $user->getWorker->fullName;
        return $fullName;
    }

    private function getInputBoxForQty($row){
        return view('hidro-projekt.ADM.inventoryCheckingListInputbox', [
            'row' => $row,
        ]);
    }

    #[On('refreshInventoryCheckingListTable')] 
    public function refreshMe(){
        $this->dispatch('refreshDatatable');
    }
}
