<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="sticky-top" style="background-color: white">
        <h1 class="h6 "><b>Gradilište</b></h1>
        <select class="form-select form-select-sm mb-2 @if (!$selectedConstructionSite) is-invalid @endif" style="display:inline" wire:model.live="selectedConstructionSite">
            <option value="0" selected>Odaberi gradilište</option>
            @foreach($constructionSites as $conSites)
                <option value="{{$conSites->id}}">{{$conSites->name}}</option>
            @endforeach
        </select>
        @if($selectedConstructionSite) 
            <div class="d-flex justify-content-between mt-2">
                <button class="btn btn-success" wire:click='addItem()'>+</button>
                <button class="btn btn-success" wire:click='addItem()'>SPREMI</button>
            </div>
            
        @endif
        <hr>
    </div>

    @if($selectedConstructionSite) 
        @foreach ($invItems as $key => $item)
            <div class="row mb-1">
                <div class="col-auto" >
                    <b>
                        #{{ sprintf('%02d', $key) }}
                        @if (!$item['table_id'])
                           ** 
                        @endif
                    </b>
                </div>
                <div class="col">
                    <label for="">Materijal</label>
                    <select class="form-select form-select-sm" wire:model.change='invItems.{{ $key }}.mat_id'>
                        <option value="0">...</option>  
                        @foreach ($mmInfo as $matNr => $matName)
                            <option value="{{ $matNr }}">{{ $matName }}</option>    
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-2" ></div>
                <div class="col-6">
                    <label for="">QTY</label>
                    <input type="number" 
                        class="form-control form-control-sm
                        @isset($inpBoxSaveState[$key]['qty']) {{ $inpBoxSaveState[$key]['qty'] }} @endisset" 
                        wire:model.blur='invItems.{{ $key }}.qty'>
                </div>
                <div class="col-4 d-flex justify-content-center">
                    <button class="btn btn-danger align-self-center" style="height: 40px">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            <hr class="my-3">
        @endforeach
    @endif
    

</div>
