<?php

namespace App\Livewire;

use App\Models\User;
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
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make("Type", "type")
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'EDIT')
                        ->location(fn($row) => route('home'))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-primary btn-sm',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'DELETE')
                        ->location(fn($row) => route('home'))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-danger btn-sm',
                            ];
                        }),
                ]),
        ];
    }
    public function builder(): Builder
    {
        return User::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('users.name', 'like', '%' . $name . '%'))
            ->when($this->columnSearch['email'] ?? null, fn ($query, $email) => $query->where('users.email', 'like', '%' . $email . '%'));
    }
}
