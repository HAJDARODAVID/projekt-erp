<div>
    @if($itemCount == 0)
    <div class="alert alert-light shadow" role="alert">        
        <p class="pt-2">
            <div class="d-flex justify-content-center">
                <i>Trenutno nema novih obavijesti!</i>
            </div>  
        </p>
    </div>
    @endif

    {{-- SHOW ITEMS  --}}
    @if($itemCount != 0)
        <div class="row">
            <div class="col">
                @foreach ($items as $key => $item)
                    @if ($item)
                        @if($key % 2 == 1)
                            @livewire('hidroProjekt.dashboard.components.system-notifications-alert-card',[
                                'item' => $item,
                            ])
                        @endif
                    @endif
                    
                @endforeach
            </div>
            <div class="col">
                @foreach ($items as $key => $item)
                    @if ($item)
                        @if($key % 2 != 1)
                            @livewire('hidroProjekt.dashboard.components.system-notifications-alert-card',[
                                'item' => $item,
                            ])
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        
        <hr>
        <div class="row">
            <div class="col-sm">
                @livewire('hidroProjekt.dashboard.components.system-notifications-alert-card',[
                    'aType' => 'danger'
                ])
            </div>
            <div class="col-sm">
                @livewire('hidroProjekt.dashboard.components.system-notifications-alert-card',[
                    'aType' => 'success'
                ])
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                @livewire('hidroProjekt.dashboard.components.system-notifications-alert-card',[
                    'aType' => 'primary'
                ])
            </div>
            <div class="col-sm">
                @livewire('hidroProjekt.dashboard.components.system-notifications-alert-card')
            </div>
        </div>
    @endif
    
</div>
