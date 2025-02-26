<ul class="nav nav-tabs">
    @foreach ($tabs as $tabKey => $tab)
        <x-ui.nav-tab-item :title=$tab :tabKey=$tabKey :selectedTab=$selectedTab method="{{ $wireClickSelectTabMethod }}" />  
    @endforeach
</ul>