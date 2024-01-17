<div>
    @livewire('hidroProjekt.bde.bde-add-worker-to-attendance-btn',[
        'worker' => $row->id,
        'workingDayEntry' => Session::get('entryID'),
        ], key($row->id))
</div>