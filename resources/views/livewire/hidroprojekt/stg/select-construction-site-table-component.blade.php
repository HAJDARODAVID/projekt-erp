<div>
    <select class="form-select form-select-sm" style="width: 350px;display:inline" wire:model.change="constSite">
        <option value="*" selected>Sva gradilišta</option>
        @foreach ($allConstSites as $key => $oneSite)
            <option value="{{ $key }}">{{ $oneSite }}</option>   
        @endforeach
    </select>
    <hr>
    @livewire('hidroProjekt.wp.construction-site-stock-table',[
        'theme' => "bootstrap-5",
        'constSite' => $constSite,
    ])
</div>
