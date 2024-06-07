<div class="d-flex gap-1">
    @livewire('hidroProjekt.adm.edit-user-modal',[
        'row' => $row,
    ], key($row->id . 'edit'))
    
    @livewire('hidroProjekt.adm.delete-user-modal',[
        'row' => $row,
    ], key($row->id . 'delete'))
</div>