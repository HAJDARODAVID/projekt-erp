<li class="nav-item">
        <button class="nav-link @if ($tabId == $activeTab) active @endif" wire:click='{{ $wireMethod }}({{ $tabId }})'>{{ $name }}</button>
</li>