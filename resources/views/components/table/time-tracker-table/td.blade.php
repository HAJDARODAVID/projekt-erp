<td 
    class="
        align-middle 
        @if($center) text-center @endif
        "
    style="
        @if($sticky) position: sticky; left: 0; z-index: 1; background-color: #fff; @endif
        @if($br) border-right: {{ $br[0] }}px {{ $br[1] }} {{ $br[2] }} !important; @endif
        @if($bl) border-left: {{ $bl[0] }}px {{ $bl[1] }} {{ $bl[2] }} !important; @endif
        @if($bt) border-top: {{ $bt[0] }}px {{ $bt[1] }} {{ $bt[2] }} !important; @endif
        @if($bb) border-bottom: {{ $bb[0] }}px {{ $bb[1] }} {{ $bb[2] }} !important; @endif
        @if($bgStyle) background-color: {{ $bgStyle }} ; @endif
        @if($textColor) color: {{ $textColor }} ; @endif
        @if($fontWeight) font-weight: {{ $fontWeight }} ; @endif
    "
    @if($wireClick) 
        wire:click='{{ $wireClick['method'] }}(@isset($wireClick['param']){{ "'".$wireClick['param']."'" }}@endisset)' 
    @endif
>
    {{ $value }}
</td>