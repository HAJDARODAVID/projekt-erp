<div class="mx-1">
    <div class="" wire:loading.remove>
        @if ($row->absence_reason != $paidLeave)
            <button class="btn btn-primary btn-sm" wire:click='updateAbsenceReason({{ $paidLeave }})'>GO</button>
        @endif

        @if ($row->absence_reason != $sickLeave)
            <button class="btn btn-warning btn-sm" wire:click='updateAbsenceReason({{ $sickLeave }})'>BO</button>
        @endif
    </div>
        
    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" style="display:none" wire:loading>
            <span class="sr-only"></span>
        </div>
    </div> 
</div>
