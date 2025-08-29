<div>
<div class="mt-3">
        <x-ui.module.header title="DNEVNIK RADOVA">
            <x-slot:actionsBtn> @livewire('modules.workday-diary.create-new-diary-modal') </x-slot>
        </x-ui.module-header>
        @livewire('modules.workday-diary.work-diary-table')
    </div>
</div>
