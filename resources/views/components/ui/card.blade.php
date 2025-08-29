<div {{ $attributes->merge(['class' => 'card '. $extendClassAtt . ' ' . $border . ' ' . $noBgColor]) }} style="border-radius: 0px;">
    @if($title || $headerActions) 
        <div class="card-header" >
            <div class="d-flex justify-content-between">
                <div class="">{{ $title }}</div>
                @if ($headerActions)
                    <div class="">{{ $headerActions }}</div>
                @endif
            </div>
        </div>
    @endif

    <div class="card-body position-relative {{ $noBodyPadding }}" style="overflow: hidden">
        <div wire:target="{{ $loading }}" wire:loading.class="blurred-content">
            {{ $slot }}
        </div>
        @if ($loading)
            <div class="loading-overlay hide-spinner" wire:loading.class="show-spinner" wire:target="{{ $loading }}" id="spinner-container">
                <div class="spinner-border text-dark " role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        @endif
    </div>
</div>