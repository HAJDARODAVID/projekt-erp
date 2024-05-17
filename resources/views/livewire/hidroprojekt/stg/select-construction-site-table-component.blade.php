<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="row">
            <div class="form-group">
                <label for="constId">Odaberi gradilište:</label><br>
                <select class="form-select form-select-sm" style="width: 350px;display:inline" wire:model.change="constSite" id="constId">
                    <option value="*" selected>Sva gradilišta</option>
                    @foreach ($allConstSites as $key => $oneSite)
                        <option value="{{ $key }}">{{ $oneSite }}</option>   
                    @endforeach
                </select>
            </div>
        </div>
        <div class="">
            <button class="btn btn-success btn-lg d-flex align-items-center" ><i class="bi bi-file-earmark-spreadsheet"></i></button>
        </div> 
    </div>   
    <hr>
    @livewire('hidroProjekt.wp.construction-site-stock-table',[
        'theme' => "bootstrap-5",
        'constSite' => $constSite,
    ])
</div>
