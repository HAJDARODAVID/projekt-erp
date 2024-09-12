<div>
    <x-modal :show=$show :blur='TRUE' size='lg'>
        <x-slot name='mainTitle'>Konfiguracija</x-slot>
        <x-slot name='secTitle'>Izvještaj: @isset($configData->r_long_name) {{ $configData->r_long_name }} @endisset</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='modalBtn(0)' wire:loading.attr='disabled'>X</button>
        </x-slot>

        {{-- BODY CONTENT --}}

        {{-- CONTAINER FOR DANGER ALERT --}}
        @isset($error['message'])
            <div class="alert alert-danger" role="alert">
                {{ $error['message'] }}
            </div> 
        @endisset

        <div class="form-group d-flex">  
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Naziv nove grupe" wire:model.blur='newGroupName'>
            </div>
            <button class="btn btn-success mx-2" wire:loading.attr='disabled' wire:click='saveNewGroup()'><i class="bi bi-floppy"></i></button>    
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h1 class="h6">Grupe:</h1>
                <div class="list-group">
                    @isset($groups)
                        @foreach ($groups as $groupName => $data)
                        <div class="list-group-item list-group-item-action 
                            @if ($groupName == $selectedGroup)
                                active
                            @endif">
                            <div class="d-flex justify-content-between">
                                @if (isset($edit['oldValue']) && $groupName == $edit['oldValue'])
                                    <div>
                                        <input class="form-control form-control-sm" type="text" value="{{ $edit['oldValue'] }}" wire:model.blur='edit.newValue'>
                                    </div>
                                @else
                                    <div style="cursor: pointer" wire:click='setSelectedGroup("{{ $groupName }}")'>{{ $groupName }}</div>  
                                @endif
                                
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
            <div class="col">
                <h1 class="h6">Dostupne kategorije:</h1>
                @if ($selectedGroup)
                    @foreach ($categories as $catID => $cat)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $catID }}" wire:model.live='selectedCategories.{{ $catID }}' @isset($cat['disabled']) disabled @endisset>
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $cat['name'] }}
                            </label>
                        </div> 
                    @endforeach
                @endif
            </div>
        </div>
    </x-modal>
    
</div>
