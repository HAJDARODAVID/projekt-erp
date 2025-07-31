@if ($link)
    <a 
        @if(Route::has($link)) href="{{ route($link) }}" @endif
        class="btn {{ $btnColor }} @if($btnSize){{ $btnSize }} @endif shadow no-border-radius">
        <div class="d-flex align-items-center gap-2">
            @if ($iconPosition == 'start')
                <x-ui.bi-icon :icon=$iconName />
            @endif
            {{ $slot }}{{ $text }}
            @if ($iconPosition == 'end')
                <x-ui.bi-icon :icon=$iconName />
            @endif
        </div>
    </a>
@else
    <button 
        class="btn {{ $btnColor }} @if($btnSize){{ $btnSize }} @endif shadow" 
        style="border-radius: 0px!Important;" wire:click='{{ $wClickMethod }}()'>
        <div class="d-flex align-items-center gap-2">
            @if ($iconPosition == 'start')
                <x-ui.bi-icon :icon=$iconName />
            @endif
            {{ $slot }}{{ $text }}
            @if ($iconPosition == 'end')
                <x-ui.bi-icon :icon=$iconName />
            @endif
        </div>
    </button>
@endif