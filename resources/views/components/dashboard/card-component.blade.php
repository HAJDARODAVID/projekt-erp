
<div class="col-md mb-3 mx-2 rounded shadow px-0 border" style="@isset($height) height: {{ $height }}px; @endisset background-color: {{ $bgColor }}" id="{{ $cardId }}">
    <div class="d-flex align-items-center rounded-top shadow" style="background-color: {{ $headerColor }};height:40px">
            <div class="h7 px-4" style="color: rgb(102, 121, 146)">
                <b>{{ strtoupper($title) }}</b>
            </div>
    </div>
    <div class="py-3 px-4 overflow-auto align-content-center"  style="height: {{ $height-40 }}px">
        @isset($livewire)
            @livewire($lw_path . $livewire)
        @endisset 
    </div> 
</div>
