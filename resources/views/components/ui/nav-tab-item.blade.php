<li class="nav-item no-border-radius">
    <button class="nav-link @if($active) active @endif no-border-radius" aria-current="page" href="#" wire:click="{{ $method }}('{{ $tabKey }}')">{{ $title }}</button>
</li>