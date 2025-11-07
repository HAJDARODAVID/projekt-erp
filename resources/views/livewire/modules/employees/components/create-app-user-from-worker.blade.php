<div>
    <x-ui.btn type="pri.sm" icon="person-plus" wClickMethod="openModal" :disabled=$disabled />

    <x-ui.modal title='Kreiranje novog korisnika' :modalStatus=$modalStatus>
        <x-ui.card :noBodyPadding=TRUE loading="closeModal, createUser" :border=FALSE>
            Stvori korisnika aplikacije za: {{$rowData->firstName}} {{$rowData->lastName}}
            <hr class="m-0 my-2">
            <div class="p-1">
                <x-ui.input label="E-mail" type="text" size="sm" class="{{ isset($error['email']) ?  'is-invalid' : NULL }} " wModel="email"/>
            </div>
            <div class="p-1">
                <x-ui.select label='Tip korisnika' :options=$userTypeOptions class="form-select-sm" wModel='userType' />
            </div>
        </x-ui.card>
        <x-slot:footerRight>
            <x-ui.btn type="suc" icon="save" wClickMethod="createUser" />
        </x-slot:footerRight>
    </x-ui.modal>
</div>
