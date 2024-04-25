<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach ($items as $item)
            @if (Route::has($item->route_name))
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link @if (Route::currentRouteName() == $item->route_name) active fw-bold @endif" 
                        id="basic-info-tab" 
                        type="button" 
                        onclick="location.href='{{ route($item->route_name,$routeParams) }}'">
                        {{ $item->name }}
                    </button>
                </li>  
            @endif
            
        @endforeach
    </ul>
</div>