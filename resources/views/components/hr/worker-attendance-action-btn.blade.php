<div class="d-flex">
    @livewire('hidroProjekt.hr.absence-worker-attendance-entry-btn',[
        'row' => $row,
    ], key($row->id))
    @livewire('hidroProjekt.hr.delete-worker-attendance-entry-btn',[
        'row' => $row,
    ], key($row->id))
</div>