<ul class="nav nav-tabs no-border-radius">
    @foreach ($tabs as $tabKey => $tab)
        <x-ui.nav-tab-item :title=$tab :tabKey=$tabKey :selectedTab=$selectedTab method="{{ $wireClickSelectTabMethod }}" :py=$py />  
    @endforeach
</ul>