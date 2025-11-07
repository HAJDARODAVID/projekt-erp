<div>
    <x-ui.btn type="lig.sm" icon="add" wClickMethod="openModal"/>

    <x-ui.modal title='create: new app module' :modalStatus=$modalStatus >
        <x-ui.card :noBodyPadding=TRUE loading="createNewDiary" :border=FALSE>
            <x-ui.card title="MODULE INFO">
                <div class="pb-2"><x-ui.input label="Name" type="text" size="sm" class="{{ isset($error['name']) ?  'is-invalid' : NULL }}" wModel="moduleInfo.name"/></div>
                <div class="pb-2"><x-ui.input label="Module" type="text" size="sm" class="{{ isset($error['module']) ?  'is-invalid' : NULL }}" wModel="moduleInfo.module"/></div>
                <div class="pb-2"><x-ui.input label="Controller" type="text" size="sm" class="{{ isset($error['controller']) ?  'is-invalid' : NULL }} " wModel="moduleInfo.controller"/></div>
            </x-ui.card>
        </x-ui.card>        
        <x-slot:footerRight><x-ui.btn type="suc" icon="save" wClickMethod="createNewAppModule" /></x-slot:footerRight>
    </x-ui.modal>
</div>
