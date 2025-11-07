<div class="modal helvetica modal-bg-blur" id="exceptionErrorMessage" style="display: @if($showModal) block @endif">
    <div class="modal-dialog" role="document">
        <div class="modal-content no-border-radius">
            <div class="alert alert-danger mb-0" role="alert">
                <h4 class="alert-heading">ERROR!</h4>
                <hr>
                <p>{{ $error }}</p>
                <hr>
                <div class="d-flex justify-content-center"><button class="btn btn-danger no-border-radius" wire:click='closeModal()'>Ok</button></div>
            </div>
        </div>
    </div>
</div>
