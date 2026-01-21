<div>
    <x-ui.btn type="suc.sm" icon="file-earmark-text" wClickMethod="openModal" />
    <x-ui.modal title="{{ translator('monthly hours report') }}" :modalStatus=$modalStatus  size="xl">
        <x-slot:subtitle>
            {{ translator('Month') }}: {{ $month }} <br>
            {{ translator('Year') }}: {{ $year }} <br>
        </x-slot:subtitle>
        <x-ui.card :noBodyPadding=TRUE loading="" :border=FALSE>
            <div class="d-flex justify-content-between p-1">
                <x-ui.input placeholder="{{ translator('Search') }}..." size="sm" :removeAddOnXP=TRUE wire:model.live.debounce.250ms='workerSearch'> 
                    @if ($workerSearch != NULL || $workerSearch != "")
                        <x-slot:append>
                            <x-ui.btn type="lig.sm" icon="trash" wClickMethod="resetArraySearchInput" />
                        </x-slot:append>
                    @endif
                </x-ui.input>
                <x-ui.btn type="suc.sm" icon="file-earmark-spreadsheet"  />
            </div>
            <hr>
        </x-ui.card> 
        @isset($data)
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ translator('Bonus') }}</th>
                        <th>{{ translator('Work hours') }}</th>
                        <th>{{ translator('Home') }}</th>
                        <th>{{ translator('Field') }}</th>
                        <th>{{ translator('PL') }}</th>
                        <th>{{ translator('SL') }}</th>
                        <th>{{ translator('HD') }}</th>
                        <th>{{ translator('Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $id => $worker)
                        @if ($worker['show-array-item-search'])
                            <tr>
                                <td>
                                    <div class="d-flex gap-2">
                                        <x-ui.employees.status-indicator :empID=$id />
                                        <x-v-divider px=0 />
                                        <div class="">{{ str_pad($id, 3, '0', STR_PAD_LEFT) }}</div>
                                        <x-v-divider px=0 />
                                        <div class="">{{ $worker['name'] }}</div>
                                    </div>
                                </td>
                                <td></td>
                                <td>{{ $worker['work-hours'] }}</td>
                                <td>{{ $worker['work-home'] }}</td>
                                <td>{{ $worker['work-field'] }}</td>
                                <td>{{ $worker['PL'] }}</td>
                                <td>{{ $worker['SL'] }}</td>
                                <td>{{ $worker['HD'] }}</td>
                                <td>{{ $worker['work-hours-total'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>   
        @endisset
               
        {{-- <x-slot:footerRight><x-ui.btn type="suc" icon="save" wClickMethod="createNewDiary" /></x-slot:footerRight> --}}
    </x-ui.modal>
    <x-ui.please-wait loading="openModal"/>
</div>
