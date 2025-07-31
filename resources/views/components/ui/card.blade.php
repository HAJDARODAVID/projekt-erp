<div {{ $attributes->merge(['class' => 'card '. $extendClassAtt]) }} style="border-radius: 0px;">
    <div class="card-header" >{{ $title }}</div>

    <div class="card-body">
        {{ $slot }}
    </div>
</div>



{{-- <div class="card @if($extend) flex-fill h-100 d-flex flex-column @endif" style="border-radius: 0px;"> --}}