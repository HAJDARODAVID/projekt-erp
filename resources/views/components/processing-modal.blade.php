<div class="modal modal-sm" id="spinner" wire:loading @if ($target)  wire:target="{{ $target }}" @endif style="{{ $blur }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">
                    Processing...
                </h6>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center" >
                    <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>