<div class="container">
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist"> 
            @foreach ($tabs as $key => $tab)
                <li class="nav-item" role="presentation">
                    @if ($tab['right'])
                        @if(app('user_rights')->hasRight('can-assign-roles') && !empty($this->userInfo))
                            <button class="nav-link @if ($key == $activeTab) active fw-bold @endif"
                            wire:click='changeActiveTab("{{ $key }}")'>
                            {{ $tab['name'] }}
                            </button>
                        @endif
                    @else
                        <button class="nav-link @if ($key == $activeTab) active fw-bold @endif"
                        wire:click='changeActiveTab("{{ $key }}")'>
                        {{ $tab['name'] }}
                        </button>
                    @endif
                    
                </li> 
            @endforeach
        </ul>

        <div class="pt-2 px-5">
            @switch($activeTab)
                @case(1)
                    @livewire('hidroProjekt.adm.acl.groups-and-resources')
                    @break
                @case(2)
                    @livewire('hidroProjekt.adm.acl.modules-rights-container')
                    @break
            
                @default
                    
            @endswitch
            
        </div>
    </div>
    
</div>