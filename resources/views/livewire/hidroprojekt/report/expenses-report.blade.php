<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="row">
            <div style="width: 400px">
                <label for="year" class="form-label">Odaberi izvještaj...</label>
                <select id="year" class="form-select" wire:model.live='selectedReport'>
                    @foreach ($reports as $key => $report)
                        <option value={{ $key }}>{{ $report['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div style="width: 200px">
                <label for="year" class="form-label">Odaberi godinu...</label>
                <select id="year" class="form-select" wire:model.live='year'>
                    @foreach ($years as $y)
                        <option value={{ $y }}>{{ $y }}</option>  
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            @if ($reports[$selectedReport]['config'])
                <button class="btn btn-success btn-lg "><i class="bi bi-gear"></i></button>
            @endif
        </div>
    </div>
    
    <hr>
    <x-dynamic-component :component="$reportComponentName" :data=$data />
</div>
