<li class="nav-item">
    <a class="nav-link @if($active) active @endif no-border-radius" href="{{ route($routeName) }}">
        @if ($title == 'Home')
            <i class="bi bi-house"></i>
        @else
            {{ $title }}
        @endif
    </a>
</li>