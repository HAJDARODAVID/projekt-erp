<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <button class="btn btn-success btn-sm" wire:click='toggleModal()'><i class="bi bi-person-plus"></i></button>

    <x-modal :show=$show :footer=FALSE :blur=TRUE>
        <x-slot:mainTitle>Prisustvo dnevnika</x-slot:mainTitle>
        <x-slot:headerBtn><button class="btn btn-dark btn-sm" wire:click='toggleModal()'>X</button></x-slot:headerBtn>
        <x-ui.nav-tabs :tabs="['Hidro-Projekt', 'Kooperanti']" :selectedTab=$selectedTab />
        <x-ui.nav-tab-content :tabKey=0 :selectedTab=$selectedTab>
            @livewire('domain.attendance.add-workers-to-report-component',[
                'wdr' => $wdr
            ])
        </x-ui.nav-tab-content>
        <x-ui.nav-tab-content :tabKey=1 :selectedTab=$selectedTab>
            koperanti
        </x-ui.nav-tab-content>
    </x-modal>
</div>
