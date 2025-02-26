<li class="nav-item">
    <button class="nav-link @if($active) active @endif" aria-current="page" href="#" wire:click="{{ $method }}({{ $tabKey }})">{{ $title }}</button>
</li>