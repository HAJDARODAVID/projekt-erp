<div style="display: @if($active)block @else none @endif" class="@if($dFlex && $active)flex-grow-1 d-flex flex-column @endif">
        {{ $slot }}
</div>
{{-- class="px-2 pt-2" --}}