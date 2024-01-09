
<?php $currentRoute = request()->route()->getPrefix() ?>

<div class="list-group mx-2" >
  @foreach ($menu_items as $key => $menuItem)
    <a 
      href="#" 
      id="{{ $key }}"
      class="list-group-item list-group-item-action @if($currentRoute == '/'.strtolower($moduleItems[$key])) active @endif" 
      onclick="showHideRoutes('{{ $key }}', '{{ $key }}_routes')" >
        {{ $key }}
    </a>
    <div style="margin-bottom: 2px; display:@if($currentRoute == '/'.strtolower($moduleItems[$key])) block @else none @endif" class="list-group py-0"  id="{{ $key }}_routes">
      @foreach ($menuItem as $item)
          @if (Route::has($item['route_name']))
            <a href="@isset($item['route_name']) {{ route($item['route_name']) }} @endisset" class="list-group-item list-group-item-action px-4 py-1" style="border-radius: 0px 0px"> - {{ $item['name'] }}</a>  
          @endif 
      @endforeach
    </div>
  @endforeach
</div>

<script>
  function showHideRoutes(moduleName, routes) {
    var x = document.getElementById(routes);
    var y = document.getElementById(moduleName);
    if (x.style.display === 'none') {
    x.style.display = 'block';
    y.classList.add("active");
    } else {
    x.style.display = 'none';
    y.classList.remove("active");
    }
  }
</script>