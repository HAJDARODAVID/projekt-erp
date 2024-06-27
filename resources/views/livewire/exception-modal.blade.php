<div class="modal" id="exceptionErrorMessage" style="display: @if($showModal) block @endif">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-danger mb-0" role="alert">
                <h4 class="alert-heading">ERROR!</h4>
                <p>{{ $error }}</p>
                <hr>
                <button class="btn btn-danger" wire:click='closeModal()'>Ok</button>
            </div>
        </div>
    </div>
</div>
