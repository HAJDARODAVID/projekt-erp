<li class="list-group-item @if($selected) activated-list-item @endif" style="cursor: pointer" wire:click="{{ $wClickMethod }}('{{ $wClickParam }}')">
    <div class="d-flex justify-content-between">
        <div class="">{{ $slot }}{{ $slotLeft }}</div>
        <div class="">{{ $slotRight }}</div>
    </div>
</li>