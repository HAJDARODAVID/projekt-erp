<div style="display: @if($btnShow) block @else none @endif">
    <div class="" wire:loading.remove>
        <button class="btn btn-success btn-sm" wire:click='addToAttendance()'><i class="bi bi-plus-circle"></i></button>  
    </div>
    <x-spinner />
</div>
