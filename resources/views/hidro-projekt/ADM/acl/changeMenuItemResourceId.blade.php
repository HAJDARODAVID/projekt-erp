<div>
    @livewire('hidroprojekt.adm.acl.change-data-in-menu-items-table', [
        'row' => $row,
        'for' => 'resource_id',
        'type' => 'select',
    ], key($row->id .'-name-'.now()))
</div>