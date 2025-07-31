<div class="">
    <div class="px-2 pb-2">
        <div class="d-flex justify-content-between align-items-center gap-1">
            <div class="d-flex gap-2">
                @if($title)
                    <div class="align-content-center">
                        <span class="h5" style="font-family: 'Helvetica', 'Arial', sans-serif;">{{ mb_strtoupper($title)  }}</span>
                    </div>
                @endif
                @if ($headerInput && $title)
                   <div class="vr"></div> 
                @endif
                @if($headerInput)
                    <div class="">
                        {{ $headerInput }}
                    </div>
                @endif
            </div>
            <div class="">{{ $actionsBtn }}</div>
        </div>
    </div>
    <hr class="m-0 mb-3">
</div>