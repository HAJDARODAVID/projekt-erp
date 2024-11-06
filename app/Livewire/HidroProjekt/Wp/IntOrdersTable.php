<?php

namespace App\Livewire\HidroProjekt\Wp;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Views\IntOrderView;
use Illuminate\Database\Eloquent\Builder;

class IntOrdersTable extends DataTableComponent
{
    //protected $model = IntOrderView::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Gradilište", "const_name")
                ->searchable()
                ->sortable(),
            Column::make("Naručio", "ordered_by")
                ->searchable()
                ->sortable(),
            Column::make("Status", "status")
                ->hideIf(TRUE),
            Column::make("Status", "status")
                ->view('hidro-projekt.wp.intOrderStatusSelectBox'),
            Column::make("Napomena", "remark")
                ->searchable(),
        ];
    }

    public function builder():Builder{
        return IntOrderView::query()
            ->orderBy('id', 'desc');
    }
}
