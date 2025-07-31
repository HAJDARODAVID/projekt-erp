<ul class="nav nav-tabs">
    @foreach ($tabs as $tabId => $tabName)
        <x-ui.tabs.item 
            name="{{ $tabName }}" 
            tabId="{{ $tabId }}" 
            :activeTab=$activeTab 
            wireMethod="{{ $wireMethod }}" 
        />
    @endforeach ()
</ul>