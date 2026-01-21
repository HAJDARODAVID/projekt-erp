<div class="modal helvetica modal-bg-blur" style="z-index:9999" wire:loading @if ($loading) wire:target='{{ $loading }}' @endif>
  <div class="modal-dialog align-content-center" style="height: 66%; width: 300px ">
    <div class="modal-content" style="border-radius: 0px;">
        <div class="modal-body">
            <div class="d-flex gap-3 justify-content-center align-items-center">
                <div class="spinner-border" role="status" style="color: rgb(0, 61, 173)">
                    <span class="sr-only"></span>
                </div>
                <div class="h5 m-0">
                    {{ translator('Please wait') }}
                    <span class="dot-anim dot1">.</span>
                    <span class="dot-anim dot2">.</span>
                    <span class="dot-anim dot3">.</span>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
