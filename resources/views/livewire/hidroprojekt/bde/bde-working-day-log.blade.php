<div>
    <div class="col d-flex justify-content-center" > 
        <button id="workLog" class="btn btn-dark " style="width: 175px;" onclick="showWorkLogModule()">
            <i class="bi bi-book"></i> DNEVNIK RADOVA
        </button>
    </div>

    <div id="workLogForm" style="display:none">
        @livewire('hidroProjekt.bde.bde-working-day-log-form', [
            'record' => $record,
        ], key($record->id))
        
    </div>
</div>