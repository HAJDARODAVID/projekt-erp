<div class="h-100 d-flex flex-column" >
    <div class="row h-100">
        <div class="col-md-5 pt-1">
            <x-ui.card title="Registered module routes" class="flex-fill d-flex flex-column">
                    <x-slot:headerActions>@livewire('modules.app-settings.components.create-new-module-route-modal',['moduleID' => $moduleID],key('create-new-route'.now()))</x-slot:headerActions>
                    <x-ui.input size="sm" placeholder="Search module routes" wModel="routeSearch" wModelEvent="live.debounce.250ms" :removeAddOnXP=TRUE>
                        @if ($routeSearch != NULL || $routeSearch != "")
                            <x-slot:append>
                                <x-ui.btn type="lig.sm" icon="trash" wClickMethod="resetModuleRouteSearchInput" />
                            </x-slot:append>
                        @endif
                    </x-ui.input>
                    <hr class="m-0 my-2">   
                    <div class="p-3 pt-0" style="position: absolute;top: 0; right: 0; bottom: 0; left: 0; margin-top: 63px;margin-bottom: 10px; overflow-y: auto">
                        @isset($appModuleRoutes)
                            <x-ui.list-group>
                                @foreach ($appModuleRoutes as $routeKey => $route)
                                    @php $isSelectedRoute = $route['id'] == $selectedModuleRoute ? TRUE : FALSE; @endphp
                                    <x-ui.list-item :selected=$isSelectedRoute wClickMethod="selectAppModuleRoute" wClickParam="{{ $route['id'] }}">
                                        <x-slot:slotLeft>
                                            <div class="d-flex gap-2">
                                                <div class="">{{ $route['title'] }}</div>
                                            </div>
                                        </x-slot:slotLeft>
                                        <x-slot:slotRight>
                                            <div class="d-flex gap-2">
                                                <ul class="custom-list">
                                                    <li class="@if ($route['routeExists']) status-green @else status-red @endif" ></li> 
                                                </ul>
                                                <x-v-divider />
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" wire:model.change='appModuleRoutes.{{ $routeKey }}.active' onclick="event.stopPropagation();" />
                                                </div>
                                                <x-v-divider />
                                                <i class="bi bi-chevron-up"></i>
                                                <i class="bi bi-chevron-down"></i>
                                            </div>
                                        </x-slot:slotRight>
                                    </x-ui.list-item>
                                @endforeach 
                            </x-ui.list-group>
                        @endisset
                    </div>
                    
                </x-ui.card>
        </div>
        <div class="col-md pt-1">
            <x-ui.nav-tabs :tabs=$tabs :selectedTab=$activeTab />
            @if ($selectedModuleRoute)
                <x-ui.nav-tab-content tabKey="module-routes-info" :selectedTab=$activeTab >
                    @livewire('modules.app-settings.components.routes-basic-info', ['routeID'=>$selectedModuleRoute], key('basic-route-info'.now()))
                </x-ui.nav-tab-content>
                <x-ui.nav-tab-content tabKey="module-routes-components" divHeight="full" :selectedTab=$activeTab >
                    test
                </x-ui.nav-tab-content>
            @else
                <div class="d-flex justify-content-center"><div class="py-3"><i>No route selected!</i></div></div>
            @endif
            
        </div>
    </div>
</div>
