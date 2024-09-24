<div>
    @livewire('hidroprojekt.adm.acl.change-data-in-menu-items-table', [
        'row' => $row,
        'for' => 'name',
        'type' => 'text',
    ], key($row->id .'-name-'.now()))
</div>