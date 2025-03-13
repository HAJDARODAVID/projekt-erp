<li class="nav-item">
    <button class="nav-link @if($active) active @endif @if($py) py-{{ $py }} @endif" aria-current="page" href="#" wire:click="{{ $method }}({{ $tabKey }})">
        {{ $title }} 
        @if($closeBtn)
            <x-ui.v-divider mx=1 />
            <i class="bi bi-x-square" wire:click="{{ $closeBtnMethod }}({{ $tabKey }})"></i>
        @endif
    </button>
</li>