<div class="form-group">
    @if ($label)
       <label>{{ $label }}</label> 
    @endif
    <div class="input-group"> 
        @if ($prepend)
            <div class="input-group-append">
                <span class="input-group-text no-border-radius">{{ $prepend }}</span>
            </div>    
        @endif
        <input 
            type="{{ $type }}" 
            {{ $attributes->merge([
                'class' => 'form-control '
                ]) }} 
            placeholder="{{ $placeholder }}" 
            style="border-radius: 0px"
            wire:model.{{ $wModelEvent }} = '{{ $wModel }}'
        >
        @if ($append)
            <div class="input-group-append">
                <span class="input-group-text no-border-radius">{{ $append }}</span>
            </div>    
        @endif
    </div>
</div>