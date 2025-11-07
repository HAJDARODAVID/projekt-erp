<li class="nav-item">
    <a class="nav-link @if($active) active @endif no-border-radius" href="{{ route($routeName) }}">
        @if ($title == 'Home' || $title == 'Index')
            @if($specialIndexIcon) 
                <i class="bi bi-{{ $specialIndexIcon }}"></i>
            @else
                <i class="bi bi-house"></i>
            @endif
        @else
            {{ $title }}
        @endif
    </a>
</li>