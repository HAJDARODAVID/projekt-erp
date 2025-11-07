<div>
    <x-ui.btn type="lig.sm" icon="trash" wClickMethod="openModal" />

    <x-ui.modal title='deaktivacija radnika' :modalStatus=$modalStatus>
        <x-ui.card :noBodyPadding=TRUE loading="closeModal, disableWorker" :border=FALSE>
            Da li ste sigurni da želite deaktivirati radnika {{$rowData->firstName}} {{$rowData->lastName}}?
            <div class="d-flex justify-content-center gap-4 mt-3">
                <x-ui.btn type="suc" icon="check-lg" wClickMethod="disableWorker"/>
                <x-ui.btn type="dan" icon="x-lg" wClickMethod="closeModal" />
            </div>
        </x-ui.card>
    </x-ui.modal>
</div>
