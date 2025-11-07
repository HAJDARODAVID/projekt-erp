<div class="row">
    <div class="col-md">
        <table class="table table-fixed-rows">
            <tbody>
                <tr>
                    <td ><b>ID</b></td>
                    <td>{{ $moduleID }}</td>
                </tr>
                <tr>
                    <td><b>Name</b></td>
                    <td><x-ui.input size="sm" wModel='moduleData.name' /></td>
                </tr>
                <tdr>
                    <td><b>Controller</b></td>
                    <td>
                        <x-ui.input size="sm" wModel='moduleData.controller' :removeAddOnXP=TRUE >
                            <x-slot:append>
                                @if ($controllerExists)
                                    <x-ui.btn type="suc.sm" icon="check2" />
                                @else
                                    <x-ui.btn type="dan.sm" icon="x-lg" />
                                @endif
                            </x-slot:append>
                        </x-ui.input>
                    </td>
                </tr>
                <tr>
                    <td><b>Module</b></td>
                    <td>
                        <x-ui.input size="sm" wModel='moduleData.module' :removeAddOnXP=TRUE >
                            <x-slot:append>
                                @if ($moduleExists)
                                    <x-ui.btn type="suc.sm" icon="check2" />
                                @else
                                    <x-ui.btn type="dan.sm" icon="x-lg" />
                                @endif
                            </x-slot:append>
                        </x-ui.input>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md">
        <table class="table table-fixed-rows">
            <tbody>
                <tr>
                    <td style="width: 150px"><b>Status</b></td>
                    <td>@isset($moduleData['status']) {{ $moduleData['status'] }}@endisset</td>
                </tr>
                <tr>
                    <td style="width: 150px"><b>Last Sync</b></td>
                    <td>2025-10-10 08:55:13</td>
                </tr>
                <tr>
                    <td style="width: 150px"><b>Resourse</b></td>
                    <td><x-ui.input size="sm" wModel='moduleData.name' :removeAddOnXP=TRUE disabled >
                            <x-slot:append>
                                <div class="d-flex gap-1">
                                    <x-ui.btn type="lig.sm" icon="node-plus" />
                                    <x-ui.btn type="dan.sm" icon="x-lg" />
                                </div>
                            </x-slot:append>
                        </x-ui.input></td>
                </tr>
            </tbody>
        </table>
    </div>
</div> 