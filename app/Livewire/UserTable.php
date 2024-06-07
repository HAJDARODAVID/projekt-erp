<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On; 
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchVisibilityStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("worker_id", "worker_id")
                ->hideIf(TRUE),
            Column::make("#", "id")
                ->sortable(),
            Column::make("Ime", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Kreiran", "created_at")
                ->sortable(),
            Column::make("Zadnja promjena", "updated_at")
                ->sortable(),
            Column::make("Type", "type")
                ->sortable(),
            Column::make("Aktivan", "active")
                ->sortable(),
            Column::make("")
                ->label(
                    fn($row) => $this->getActionButtons($row)
                )->html(),
        ];
    }
    public function builder(): Builder
    {
        return User::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('users.name', 'like', '%' . $name . '%'))
            ->when($this->columnSearch['email'] ?? null, fn ($query, $email) => $query->where('users.email', 'like', '%' . $email . '%'));
    }

    private function getActionButtons($row){
        return view('hidro-projekt.ADM.userTableActionButtons',[
            'row' => $row,
        ]);
    }

    public function setTableRowClass($row): ?string{
        return $row->active == FALSE ? 'bg-green-500' : null;
    }

    #[On('refreshUserTable')] 
    public function refreshMe(){
        $this->dispatch('refreshDatatable');
    }
}
