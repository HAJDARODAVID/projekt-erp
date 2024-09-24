<div>
    @switch($type)
        @case('text')
            <input type="text" class="form-control form-control-sm" value="{{ $row->$for }}" wire:model.blur='data.{{ $for }}'>
            @break
        @case('select')
            <div class="form-group">
                <select class="form-control form-control-sm" wire:model.change='data.{{ $for }}'>
                    @if ($for == 'resource_id')
                        <option value="NULL">NULL</option>    
                    @endif
                    @foreach ($dropDownItems as $items)
                        @if ($for == 'resource_id')
                            <option value="{{ $items->id }}">{{ $items->resources }}</option>    
                        @endif
                        @if ($for == 'module_id')
                            <option value="{{ $items->id }}">{{ $items->name }}</option>    
                        @endif  
                    @endforeach
                </select>
            </div> 
            @break
    
        @default
            {{ $row->$for }} 
    @endswitch
</div>
