
<?php $currentRoute = request()->route()->getPrefix() ?>

<div class="list-group mx-2" style="max-height:750px;
   overflow-y: scroll;
">
  @foreach ($menu_items as $key => $menuItem)
    <a 
      href="#" 
      id="{{ $key }}"
      class="list-group-item list-group-item-action @if($currentRoute == "/".strtolower($menu_items[$key][0]['get_owner']['module_prefix'])) active @endif" 
      onclick="showHideRoutes('{{ $key }}', '{{ $key }}_routes')" >
        {{ $key }}
    </a>
    <div style="margin-bottom: 2px; display:@if($currentRoute == "/".strtolower($menu_items[$key][0]['get_owner']['module_prefix'])) block @else none @endif" class="list-group py-0"  id="{{ $key }}_routes">
      @foreach ($menuItem as $item)
          @if (Route::has($item['route_name']))
            <a href="@isset($item['route_name']) {{ route($item['route_name']) }} @endisset" class="list-group-item list-group-item-action px-4 py-1" style="border-radius: 0px 0px"> - {{ $item['name'] }}</a>  
          @endif 
      @endforeach
    </div>
  @endforeach
  @if(Auth::user()->id == 1 || Auth::user()->id == 2)
    <hr>
    <a 
      href="{{ route('hp_calculator') }}" 
      class="list-group-item list-group-item-action" >
          Kalkulator
    </a>
  @endif

  @if($activeInventory)
    <a 
      href="{{ route('hp_activeInventoryChecking', $activeInventory->inv_name) }}" 
      class="list-group-item list-group-item-action" >
          <b>INVENTURA: {{ $activeInventory->inv_name }}</b>
    </a>
  @endif

  @if(Session::get('is_phone'))
    <hr>
    <a class="list-group-item list-group-item-action" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><b>Odjava</b></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
  </form>
  @endif
  
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