<th 
    scope="col" 
    style="
        @if($width) width: {{ $width }}px !important; @endif
        @if($br) border-right: {{ $br[0] }}px {{ $br[1] }} {{ $br[2] }} !important; @endif
        @if($bl) border-left: {{ $bl[0] }}px {{ $bl[1] }} {{ $bl[2] }} !important; @endif
        @if($bt) border-top: {{ $bt[0] }}px {{ $bt[1] }} {{ $bt[2] }} !important; @endif
        @if($bb) border-bottom: {{ $bb[0] }}px {{ $bb[1] }} {{ $bb[2] }} !important; @endif
        @if($bgStyle) background-color: {{ $bgStyle }} ; @endif
        @if($sticky) position: sticky; left: 0; z-index: 1; background-color: #fff; @endif
        " 
    class="
        @if($center) text-center @endif
        "
>
    {{ strtoupper($name) }}
</th>