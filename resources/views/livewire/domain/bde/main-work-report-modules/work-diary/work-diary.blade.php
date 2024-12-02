<div>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="">
            <span class="h5"> <b>Dnevnik radova</b> </span>
        </div>
        <div class="">
            <button class="btn btn-success" wire:click="saveDiary()" wire:loading.attr="disabled" wire:target='saveDiary()'><i class="bi bi-floppy"></i></button>
        </div>
    </div>
    <div class="form-group mb-2">
        <textarea class="form-control" rows="4" wire:model.blur="diaryTxt" wire:loading.attr="disabled" wire:target='saveDiary()'></textarea>
    </div>
    <hr>
    @foreach ($allDiaries as $diary)
        <div class="container mb-2" >
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="">
                                <div class="modal-header">
                                    <span class="modal-title">{{ date("h:i:sa", strtotime($diary->created_at)) }}</span>
                                    <div>
                                        <button class="btn btn-primary btn-sm" wire:click='editDiary({{ $diary->id }})'>
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" wire:click='deleteDiary({{ $diary->id }})'>
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div> 
                        </div>
                        <div class="card-body pt-1 pb-0" >
                            <p style="white-space: pre-line">{{ $diary->log }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    @endforeach
</div>
