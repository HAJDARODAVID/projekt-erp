<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="row g-3">
            <div class="col" style="width: 200px">
                <label for="year" class="form-label"><b>Godina</b></label>
                <select id="year" class="form-select" wire:model.live='year'>
                    <option value="">Odaberi...</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
            </div>
            <div class="col" style="width: 200px">
            <label for="month" class="form-label"><b>Mjesec</b></label>
            <select id="month" class="form-select" wire:model.live='month'>
                <option value="">Odaberi...</option>
                @foreach ($allMonths as $key => $month)
                    <option value="{{ $key }}">{{ $month }}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="d-flex gap-1">
            <button class="btn btn-primary btn-lg d-flex align-items-center"><i class="bi bi-arrow-clockwise"></i></button>
            <button class="btn btn-success btn-lg d-flex align-items-center"><i class="bi bi-floppy"></i></button>
            <button class="btn btn-success btn-lg d-flex align-items-center"><i class="bi bi-file-earmark-spreadsheet"></i></button>
        </div>
    </div>
    <hr>
</div>
