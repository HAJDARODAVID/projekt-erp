<div>
    @isset($reportData)
        <div class="row px-2">
            <div class="col-md-2">
                <x-ui.input placeholder="{{ translator('Search') }}..." size="sm" :removeAddOnXP=TRUE wire:model.live.debounce.250ms='search'> 
                    @if ($search != NULL || $search != "")
                        <x-slot:append>
                            <x-ui.btn type="lig.sm" icon="trash" wClickMethod="resetArraySearchInput" />
                        </x-slot:append>
                    @endif
                </x-ui.input>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end"><button>test</button></div>
            </div>
        </div>
        
        <hr>
        <div class="tableFixHead">
            <table class="table table-responsive table-sm table-striped ">
                <thead >
                    <tr>
                        <th style="">{{ translator('Construction site') }}</th>
                        <th style="text-align: center">{{ translator('On stock') }}[€]</th>
                        <th style="text-align: center">{{ translator('Consumption') }}[€]</th>
                        <th style="text-align: center">{{ translator('Work hours') }}[h]</th>
                        <th style="text-align: center">{{ translator('Work hours') }}[€]</th>
                        <th style="text-align: center">{{ translator('Vehicle cost') }}[€]</th>
                        <th style="text-align: center">{{ translator('Total') }}[€]</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportData as $id => $item)
                        @if ($item['show-array-item-search'])
                            <tr>
                                <td>
                                    <div class="d-flex gap-2">
                                        <div class="">{{ str_pad($item['jobSiteID'], 4, '0', STR_PAD_LEFT) }}</div>
                                        <x-v-divider px=0 />
                                        <div class="">{{ $item['jobSiteName'] }}</div>
                                    </div>
                                </td>
                                <td style="text-align: center">{{ number_format(floatval($item['onStockValue']),2,',','.') }}</td>
                                <td style="text-align: center">{{ number_format(floatval($item['consumptionsValue']),2,',','.') }}</td>
                                <td style="text-align: center">{{ number_format(floatval($item['workHours']),2,',','.') }}</td>
                                <td style="text-align: center">{{ number_format(floatval($item['workHoursValue']),2,',','.') }}</td>
                                <td style="text-align: center">{{ number_format(floatval($item['allocatedVehicleExpense']),2,',','.') }}</td>
                                <td style="text-align: center">{{ number_format(floatval($item['total']),2,',','.') }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table> 
        </div>  
    @endisset
</div>
