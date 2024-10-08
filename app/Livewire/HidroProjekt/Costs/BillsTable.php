<?php

namespace App\Livewire\HidroProjekt\Costs;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BillModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;
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
            Column::make("Iznos[€]", "amount")
                ->hideIf(TRUE),
            Column::make("inc_pdv", "inc_pdv")
                ->hideIf(TRUE),

            Column::make("Poslužitelj", "getProvider.provider")
                ->sortable()
                ->searchable(),
            Column::make("Kategorija", "getCategory.category")
                ->sortable()
                ->searchable(),
            Column::make("Iznos[€]")
                ->label(fn($row) =>  $this->getAmount($row)) 
                ->footer(
                    fn($rows) => '<strong>' . number_format((float)$rows->sum('amount'), 2, ',', '.') . '</strong>'
                )->html(),
            Column::make("Iznos[€](bez PDV-a)")
                ->label(fn($row) => number_format((float)$row->amountWithoutPdv, 2, ',', '.') )
                ->footer(
                    fn($rows) => '<strong>' . number_format((float)$rows->sum('amountWithoutPdv'), 2, ',', '.') . '</strong>'
                )->html(),
            Column::make("Datum", "date")
                ->sortable(),
            Column::make("Napomena", "remark")
                ->sortable(),
            Column::make('','id')
                ->view('hidro-projekt.COSTS.billsTableActionBtns'),
        ];
    }

    private function getAmount($row){
        $amount = number_format($row->amount, 2, ',', '.');
        $indicator = $row->inc_pdv == TRUE ? '' :'<span style="color:#B22222"><b>***</b></span>';
        $string = $amount . $indicator;
        return $string;
    }

    public function builder(): Builder{
        return BillModel::query()->orderBy('id', 'desc');
    }

    #[On('refresh-bills-table')] 
    public function refreshMe(){
        return;
    }
}
