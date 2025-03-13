<ul class="nav nav-tabs">
    @foreach ($tabs as $tabKey => $tab)
        <x-ui.nav.tab-item :title=$tab :tabKey=$tabKey :selectedTab=$selectedTab method="{{ $wireClickSelectTabMethod }}" :closeBtn=$removeTab closeBtnMethod="{{ $wireClickRemoveTabMethod }}" :py=$py />  
    @endforeach
    @if ($addTabs)
        <x-ui.v-divider mx=1 />
        <li class="nav-item">
            <button class="nav-link active" href="#" wire:click="{{ $wireClickAddTabMethod }}()">+</button>
        </li>
    @endif
</ul>