<x-ui.card.basic-card>
    <x-slot name='title'>{{ $worker->fullName }}</x-slot>
    <x-slot name='tabs'> <x-ui.nav.tabs :tabs=$tabs :selectedTab=$selectedTab py="1" /></x-slot>
</x-ui.card.basic-card>
