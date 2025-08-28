<div>
    <x-ui.btn type="dan.sm" icon="trash" wClickMethod="openModal" />

    <x-ui.modal alert="warning" title="prisustvo" :modalStatus=$modalStatus>    
        Da li želite zadržati prisustvo radnika ili ga u potpusnoti obrisati?
        <div class="d-flex justify-content-center gap-2 mt-2">
            <x-ui.btn type="suc.sm" wClickMethod="deleteThisDiaryAction" wClickParam="true">ZADRŽI</x-ui.btn>
            <x-ui.btn type="dan.sm" wClickMethod="deleteThisDiaryAction" wClickParam="false">OBRIŠI</x-ui.btn>
        </div>
    </x-ui.modal>
</div>
