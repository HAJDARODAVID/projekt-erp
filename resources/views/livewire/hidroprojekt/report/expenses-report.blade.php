<div>
    <div class="row">
        <div style="width: 400px">
            <label for="year" class="form-label">Odaberi izvještaj...</label>
            <select id="year" class="form-select" wire:model.live='year'>
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
    <hr>
    {{-- <x-reports.{{ $activeReport }} :data=$data/> --}}
    <x-dynamic-component :component="$reportComponentName" :data=$data />
</div>
