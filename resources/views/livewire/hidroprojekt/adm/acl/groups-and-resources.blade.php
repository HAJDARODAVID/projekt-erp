<div>
    <div class="row gap-3">
        <div class="col border border-light py-2">
            <h1 class="h5">Roles:</h1>
            <div class="list-group">
                @isset($groups)
                    @foreach ($groups as $groupName => $data)
                    <div class="list-group-item list-group-item-action 
                        @if ($groupName == $selectedGroup)
                            active
                        @endif">
                        <div class="d-flex justify-content-between">
                            {{-- @if (isset($edit['oldValue']) && $groupName == $edit['oldValue'])
                                <div>
                                    <input class="form-control form-control-sm" type="text" value="{{ $edit['oldValue'] }}" wire:model.blur='edit.newValue'>
                                </div>
                            @else --}}
                                <div style="cursor: pointer" wire:click='setSelectedGroup("{{ $groupName }}")'>{{ $groupName }}</div>  
                            {{-- @endif --}}
                            
                            <div>
                                <button class="btn btn-success btn-sm" wire:click='enableEdit("{{ $groupName }}")'><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger btn-sm" wire:click='deleteGroup("{{ $groupName }}")'><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endisset    
            </div>
        </div>
        <div class="col border border-light py-2">
            <h1 class="h5">Resources:</h1>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" >
                    <label class="form-check-label" for="flexCheckDefault">
                        TEST
                    </label>
                </div> 
        </div>
    </div>
</div>
