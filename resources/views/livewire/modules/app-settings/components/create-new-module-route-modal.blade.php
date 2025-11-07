<div>
    <x-ui.btn type="lig.sm" icon="add" wClickMethod="openModal"/>

    <x-ui.modal title='create: new app module route' :modalStatus=$modalStatus >
        <x-ui.card :noBodyPadding=TRUE loading="createNewAppModuleRoute" :border=FALSE>
            <x-ui.card title="ROUTE FORM">
                <div class="pb-2">
                    <x-ui.input 
                        label="Route title" 
                        type="text" size="sm" 
                        class="{{ isset($error['title']) ?  'is-invalid' : NULL }}" 
                        wModel="routeInfo.title" />
                </div>
                <div class="pb-2">
                    <x-ui.input 
                        label="Route name" 
                        type="text" size="sm" 
                        class="{{ isset($error['route_name']) ?  'is-invalid' : NULL }}" 
                        wModel="routeInfo.route_name"
                        tooltip="Define the name assigned to the route." />
                </div>
                <div class="pb-2">
                    <x-ui.input 
                        label="Method" 
                        type="text" size="sm" 
                        class="{{ isset($error['method']) ?  'is-invalid' : NULL }}" 
                        wModel="routeInfo.method"
                        tooltip="Define the method for this route."/>
                </div>
            </x-ui.card>
        </x-ui.card>        
        <x-slot:footerRight><x-ui.btn type="suc" icon="save" wClickMethod="createNewAppModuleRoute" /></x-slot:footerRight>
    </x-ui.modal>
</div>
