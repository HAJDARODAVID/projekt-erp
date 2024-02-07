<div>
    @livewire('hidroProjekt.bde.bde-add-co-op-workers-to-attendance',[
        'entry' => Session::get('entryID'),
        'coOpTeam' => $row->id
        ], key($row->id))
</div>