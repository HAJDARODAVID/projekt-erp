<div class="d-flex justify-content-center" >
    <div class="spinner-border" role="status" style="display:none" wire:loading @if ($target) wire:target='{{ $target }}' @endif>
        <span class="sr-only"></span>
    </div>
</div>