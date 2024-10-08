<div>
    @if(app('user_rights')->hasRight('create-resources-or-roles'))
        <div class="d-flex justify-content-end">
            @livewire('hidroProjekt.adm.acl.add-new-role-or-resource')
        </div>
        <hr>
    @endif
    <div class="row gap-3">
        <div class="col border border-light py-2">
            <h1 class="h5">Roles:</h1>
            <div class="list-group">
                @isset($roles)
                    @foreach ($roles as $role)
                    <div class="list-group-item list-group-item-action 
                        @if ($role->id == $selectedRole)
                            active
                        @endif">
                        <div class="d-flex justify-content-between">
                            {{-- @if (isset($edit['oldValue']) && $groupName == $edit['oldValue'])
                                <div>
                                    <input class="form-control form-control-sm" type="text" value="{{ $edit['oldValue'] }}" wire:model.blur='edit.newValue'>
                                </div>
                            @else --}}
                                <div style="cursor: pointer" wire:click='setSelectedRole("{{ $role->id }}")'>{{ $role->name }}</div>  
                            {{-- @endif --}}
                            
                            <div>
                                <button class="btn btn-success btn-sm" wire:click='enableEdit("{{ $role->id }}")'><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger btn-sm" wire:click='deleteGroup("{{ $role->id }}")'><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endisset    
            </div>
        </div>
        <div class="col border border-light py-2">
            <div class="d-flex justify-content-between">
                <h1 class="h5">Resources:</h1>
                <div class="input-group" style="width:200px" >
                    <input class="form-control form-control-sm" type="text" placeholder="Search" wire:model.blur='searchResources'>
                    @if ($searchResources)
                        <div class="input-group-append">
                            {{-- <div class="input-group-text">€</div> --}}
                            <button class="btn btn-danger btn-sm" wire:click='resetSearch()'>X</button>
                        </div>
                    @endif
                </div>
            </div>
           
            @foreach ($resources as $rs)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $rs->id }}" wire:model.live='selectedResources.{{ $rs->id }}' @if(!$selectedRole) disabled @endif>
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $rs->resources }}
                    </label>
                </div> 
            @endforeach
        </div>
    </div>
</div>
