

<div class="form-group">
    @if ($label)
       <label>{{ $label }}</label> 
    @endif
    <select {{ $attributes->merge(['class' => 'no-border-radius form-select ']) }}
        wire:model.{{ $wModelEvent }} = '{{ $wModel }}' >
        @if ($initOption)
            <option value="init-option" selected>{{ $initOption }}</option>
        @endif
        @foreach ($options as $value => $option)
            <option value="{{ $value }}">{{ $option }}</option>
        @endforeach
    </select>
</div>