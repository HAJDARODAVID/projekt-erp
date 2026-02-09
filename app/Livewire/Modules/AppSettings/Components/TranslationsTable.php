<?php

namespace App\Livewire\Modules\AppSettings\Components;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Translation\AppTranslation;

class TranslationsTable extends DataTableComponent
{
    protected $model = AppTranslation::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Value", "value")
                ->sortable(),
            Column::make("Lang", "lang")
                ->sortable(),
            Column::make("Translation", "translation")
                ->sortable(),
        ];
    }
}
