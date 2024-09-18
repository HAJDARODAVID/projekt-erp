<div>
    @hasRights(create-or-edit-bills)
        @livewire('hidroProjekt.costs.add-new-bill-modal-component',[
            'edit' => TRUE,
            'bill' => $row,
        ], key($row->id.now()))
    @endHasRights
</div>