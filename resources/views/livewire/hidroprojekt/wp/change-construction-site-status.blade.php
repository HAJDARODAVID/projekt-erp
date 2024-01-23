<div class="d-flex align-items-center">
    <div class="align-self-end">
        <div class="d-flex flex-row">
            <select class="form-select form-select-sm" name="" id="" style="display:inline" wire:model.live = "status">
                @foreach ($allStatuses as $key => $st)
                    <option value="{{ $key }}" style="color: {{ $statusColor[$key] }}">{{ $st }}</option>   
                @endforeach
            </select>
        </div>
    </div>
</div>
