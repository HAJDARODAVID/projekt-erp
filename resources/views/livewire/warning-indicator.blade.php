<div style="display: @if($show) block @else none @endif" wire:poll.300s='getIndicator()'>
    <i class="bi bi-exclamation-triangle-fill" style="color: yellow"></i>
</div>
