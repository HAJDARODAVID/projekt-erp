<div>
    {{-- Do your work, then step back. --}}
    <div>
        <span style="cursor: pointer; display:@if($displayInput) none @endif" wire:click='openInputBox()'>
            {{ $qty }}
        </span>
        <input type="number" class="form-control input-sm" style="display:@if($displayInput) block @else none @endif; width: 100px" wire:model.blur = 'qty'>
    </div>
</div>
