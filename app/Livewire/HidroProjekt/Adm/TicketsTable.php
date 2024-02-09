<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\TicketModel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class TicketsTable extends DataTableComponent
{
    protected $model = TicketModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
            return route('hp_showTicket', $row->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("TicketName", "ticketName")
                ->searchable(),
            Column::make("Job description", "job_description")
                ->sortable(),
            Column::make("Priority", "priority")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
        ];
    }

    public function builder(): Builder{
        return TicketModel::query()
            ->where('status', '!=', -1);
    }
}
