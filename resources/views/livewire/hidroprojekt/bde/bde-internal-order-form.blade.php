<div>
    <h1 class="h6 "><b>Gradilište</b></h1>
    <select class="form-select form-select-sm mb-2 @if (!$selectedCs) is-invalid @endif" style="display:inline" wire:model.live="selectedCs">
        <option value="" selected>Odaberi gradilište</option>
        @foreach($allCs as $cs)
            <option value="{{$cs->id}}">{{$cs->name}}</option>
        @endforeach
    </select>

    @if ($selectedCs)
        <hr>
        <div class="col-md mb-3 rounded shadow border px-0">
            <div class="d-flex justify-content-between align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:40px">
                <div class="h7 px-4" style="color: rgb(102, 121, 146)">
                    <b>{{ strtoupper('popis materijala') }}</b>
                </div>
                <div class="px-4">
                    <button class="btn btn-success btn-sm" wire:click='addItem()'> + </button>
                </div>
            </div>
            <div class="py-3 px-4">
                @php
                    $i=1;
                @endphp
                @foreach ($items as $key => $item)
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">#{{ $i }}</div>
                        <div class="col">
                            <div class="row mb-2">
                                <label for="">Materijal</label>
                                <select class="form-select form-select-sm @isset($error[$key]['mat']) is-invalid @endisset" wire:model.change='items.{{ $key }}.mat'>
                                    <option value="NULL">...</option>  
                                    @foreach ($mmInfo as $mat)
                                        <option value="{{ $mat->id }}">{{ $mat->name }}</option>    
                                    @endforeach
                                </select>
                            </div>
                            <div class="row d-flex">
                                <div class="col px-0">
                                    <label class="col px-2" for="">Kol.</label>
                                    <input type="number" class="form-control form-control-sm @isset($error[$key]['qty']) is-invalid @endisset" wire:model.blur='items.{{ $key }}.qty'>
                                </div>
                                <div class="col d-flex justify-content-center px-2">
                                    <div class="align-content-center">
                                        <button class="btn btn-danger btn-sm " wire:click='removeItem({{ $key }})'><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="p-0 m-0 my-2">
                    </div> 
                    @php
                        $i++;
                    @endphp
                @endforeach
                               
            </div>
        </div>

        <div class="col-md mb-3 rounded shadow border px-0">
            <div class="d-flex justify-content-between align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:40px">
                <div class="h7 px-4" style="color: rgb(102, 121, 146)">
                    <b>{{ strtoupper('napomena') }}</b>
                </div>
            </div>
            <div class="py-3 px-4">
                <textarea class="form-control" rows="4" style="resize: none;" wire:model='remark'></textarea>              
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button class="btn btn-success" style="height: 50px" wire:click='createOrder()'>SPREMI NARUDŽBENICU <i class="bi bi-box-arrow-right"></i></button> 
        </div>
         
    @endif
</div>
