<div class="d-flex gap-1">
    @livewire('hidroProjekt.adm.edit-user-modal',[
        'row' => $row,
    ], key($row->id . 'edit'))
    
    @if ($row->active)
        @livewire('hidroProjekt.adm.delete-user-modal',[
            'row' => $row,
        ], key($row->id . 'delete'))      
    @endif
    
</div>