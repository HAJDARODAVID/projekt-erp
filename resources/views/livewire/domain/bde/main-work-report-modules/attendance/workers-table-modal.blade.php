<div>
    <button class="btn btn-success btn-sm mx-2" wire:click='toggleModal()'><i class="bi bi-person-add"></i></button>

    <x-modal :show=$show >
        <x-slot:mainTitle>Popis radnika</x-slot:mainTitle>
        <x-slot:headerBtn><button class="btn btn-dark btn-sm" wire:click='toggleModal()'>X</button></x-slot:headerBtn>
        @livewire('domain.bde.main-work-report-modules.attendance.workers-for-attendance-table', [
            'theme' => "bootstrap-5"])
    </x-modal>
</div>
