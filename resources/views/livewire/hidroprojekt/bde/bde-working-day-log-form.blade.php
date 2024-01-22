<div>
    <div class="form-group mb-2">
        <label for="exampleFormControlTextarea1">Dnevnik radova</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" wire:model.blur="log"></textarea>
    </div>
    <div class="row"> 
        <div class="col d-flex justify-content-center">
            <button type="submit" class="btn btn-success" wire:click.prevet="saveLog()">SPREMI</button>
        </div>
    </div>

    <hr>
    <div wire:loading.remove>
        @foreach ($allLogs as $oneLog)
        <div class="container mb-2" >
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="">
                                <div class="modal-header">
                                    <span class="modal-title">{{ date("h:i:sa", strtotime($oneLog->created_at)) }}</span>
                                    <div>
                                        <button class="btn btn-primary btn-sm" wire:click='editLog({{ $oneLog->id }})'>
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" wire:click='deleteLog({{ $oneLog->id }})'>
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div> 
                        </div>
                        <div class="card-body pt-1 pb-0" >
                            <p style="white-space: pre-line">{{ $oneLog->log }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        @endforeach
    </div>
    

    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" wire:loading>
            <span class="sr-only"></span>
        </div>
    </div>
    
</div>
