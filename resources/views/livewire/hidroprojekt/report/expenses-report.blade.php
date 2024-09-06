<div>
    <div class="row">
        <div style="width: 200px">
            <label for="year" class="form-label">Odaberi godinu...</label>
            <select id="year" class="form-select" wire:model.live='year'>
                <option value="">Odaberi...</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
        <div style="width: 400px">
            <label for="year" class="form-label">Odaberi godinu...</label>
            <select id="year" class="form-select" wire:model.live='year'>
                <option value="">Odaberi...</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
    </div>
    <hr>
    {{-- <x-reports.{{ $activeReport }} :data=$data/> --}}
    <x-dynamic-component :component="$activeReport" :data=$data />
</div>
