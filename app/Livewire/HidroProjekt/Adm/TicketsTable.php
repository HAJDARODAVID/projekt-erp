<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\TicketModel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class TicketsTable extends DataTableComponent
{
    protected $model = TicketModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
            return route('hp_showTicket', $row->id);
            });
        $this->setFilter('status', '1');
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
            ->where('status', '!=', -1)
            ->orderBy('id', 'desc');
    }

    public function filters(): array{
        return [
        SelectFilter::make('Status', 'status')
            ->options(TicketModel::TICKET_STATUS)
            ->filter(function(Builder $builder, string $value) {
                $builder->where('status', $value);
            }),

        ];
    }
}
