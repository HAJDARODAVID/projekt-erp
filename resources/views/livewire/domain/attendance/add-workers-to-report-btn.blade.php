<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <button class="btn btn-success btn-sm" wire:click='toggleModal()'><i class="bi bi-person-plus"></i></button>

    <x-modal :show=$show >
        <x-slot:mainTitle>Prisustvo dnevnika</x-slot:mainTitle>
        <x-slot:headerBtn><button class="btn btn-dark btn-sm" wire:click='toggleModal()'>X</button></x-slot:headerBtn>
        <x-ui.nav-tabs :tabs="['Hidro-Projekt', 'Kooperanti']" :selectedTab=$selectedTab />
        {{ var_export($selectedTab) }}
    </x-modal>
</div>
