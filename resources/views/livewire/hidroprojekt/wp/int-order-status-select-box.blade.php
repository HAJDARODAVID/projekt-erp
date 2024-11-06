<div>   
    <select class="form-control form-control-sm {{ $saved }}" style="width: 110px" wire:model.change='orderStatus'>
        @foreach ($statuses as $statusKey => $status)
            <option value="{{ $statusKey }}">{{ $status }}</option>
        @endforeach
    </select>
</div>
