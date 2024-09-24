<div>
    @switch($type)
        @case('text')
            <input type="text" class="form-control form-control-sm" value="{{ $row->$for }}" wire:model.blur='data.{{ $for }}'>
            @break
        @case('select')
            <div class="form-group">
                <select class="form-control form-control-sm" wire:model.change='data.{{ $for }}'>
                    @foreach ($dropDownItems as $items)
                        <option value="{{ $items->id }}">{{ $items->name }}</option>    
                    @endforeach
                </select>
            </div> 
            @break
    
        @default
            {{ $row->$for }} 
    @endswitch
</div>
