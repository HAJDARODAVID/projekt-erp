<div class="list-group-item {{ $priority[$item->priority] }} py-1">
    <div class="d-flex justify-content-between align-items-center">
        <div class="">
            <div class="pb-1" style="font-size: 15px;">
                <b>{{ $item->task }}</b>
            </div>
            <div style="font-size: 12px;">
                @if($item->from)
                    <div class="">Od: Amet Consectetur</div> 
                @endif
                @if($item->deadline)
                    <div class="">Termin: {{ $item->deadline }}</div>
                @endif
            </div>
            
        </div>
        <div class="">
            <button class="btn btn-success btn-sm shadow"><i class="bi bi-check"></i></button>
            <button class="btn btn-danger btn-sm shadow"><i class="bi bi-x-circle"></i></button>
        </div>
    </div>
</div>

