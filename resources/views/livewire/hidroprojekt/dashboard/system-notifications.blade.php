<div wire:poll.60s>
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
            <div class="col-sm">
                @foreach ($items as $key => $item)
                    @if ($item)
                        @if($key % 2 == 1)
                            @livewire('hidroProjekt.dashboard.components.system-notifications-alert-card',[
                                'item' => $item,
                            ], key($item->id . now()))
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="col-sm">
                @foreach ($items as $key => $item)
                    @if ($item)
                        @if($key % 2 != 1)
                            @livewire('hidroProjekt.dashboard.components.system-notifications-alert-card',[
                                'item' => $item,
                            ], key($item->id . now()))
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    
</div>
