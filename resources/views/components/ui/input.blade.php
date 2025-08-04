<div class="form-group">
    @if ($label)
       <label>{{ $label }}</label> 
    @endif
    <div class="input-group {{ $inputGroupSize }}"> 
        @if ($prepend)
            <div class="input-group-append">
                <span class="input-group-text no-border-radius" style="padding-bottom: 0px; padding-top: 0px; height: 100%">{{ $prepend }}</span>
            </div>    
        @endif
        <input 
            type="{{ $type }}" 
            {{ $attributes->merge([
                'class' => 'form-control '
                ]) }} 
            placeholder="{{ $placeholder }}" 
            style="{{ implode('; ', $style) }}"
            wire:model.{{ $wModelEvent }} = '{{ $wModel }}'
        >
        @if ($append)
            <div class="input-group-append">
                <span class="input-group-text no-border-radius {{ $removeAddOnXP }}" style="padding-bottom: 0px; padding-top: 0px; height: 100%">{{ $append }}</span>
            </div>    
        @endif
    </div>
</div>