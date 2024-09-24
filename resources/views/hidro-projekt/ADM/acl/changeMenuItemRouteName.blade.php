<div>
    @livewire('hidroProjekt.adm.acl.change-data-in-menu-items-table', [
        'row' => $row,
        'for' => 'route_name',
        'type' => 'text',
    ], key($row->id .'-name-'.now()))
</div>