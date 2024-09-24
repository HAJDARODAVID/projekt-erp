<?php

namespace App\Livewire\HidroProjekt\Adm\Acl;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ModuleItemsRouteModel;
use Illuminate\Database\Eloquent\Builder;

class MenuItemsTable extends DataTableComponent
{
    protected $model = ModuleItemsRouteModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("NameHidden", "name")
                ->searchable()
                ->hideIf(TRUE),
            Column::make("RouteNameHidden", "route_name")
                ->searchable()
                ->hideIf(TRUE),
            Column::make("Name", "name")
                ->view('hidro-projekt.ADM.acl.changeMenuItemName'),
            Column::make("Route name", "route_name")
                ->view('hidro-projekt.ADM.acl.changeMenuItemRouteName'),
            Column::make("Module", "module_id")
                ->view('hidro-projekt.ADM.acl.changeMenuItemModuleId'),
            Column::make("Resource", "resource_id")
                ->view('hidro-projekt.ADM.acl.changeMenuItemResourceId'),
        ];
    }

    public function builder(): Builder{
        return ModuleItemsRouteModel::query()
            ->orderBy('module_id', 'ASC');
    }
}
