<x-ui.card.basic-card :resetP=TRUE>
    <x-slot name='title'>Evidencija radnih sati </x-slot>
    <x-slot name='tabs'> <x-ui.nav.tabs :tabs=$tabs :selectedTab=$selectedTab /></x-slot>
    <x-ui.nav.tab-content tabKey=0 :selectedTab=$selectedTab>
        @livewire('domain.time-tracker.time-tracker')
    </x-ui.nav.tab-content>

    <x-ui.nav.tab-content tabKey=1 :selectedTab=$selectedTab :dFlex=TRUE>
        @livewire('domain.time-tracker.time-tracker-per-worker')
    </x-ui.nav.tab-content>
    
</x-ui.card.basic-card> 