<div wire:poll="refreshData" style="overflow:scroll; overflow-x: hidden;height:750px; width:inherit;">
    <div class="table-responsive">
        <table class="table">
            <thead class="sticky-top" style="background-color:rgb(240, 240, 240)">
                <tr>
                    <th>#Mat</th>
                    <th>Materijal</th>
                    <th>Lokacija</th>
                    <th>Gradilište</th>
                    <th>Qty</th>
                    <th>Inv qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stock as $item)
                    <?php 
                        $class=NULL;
                        $invStockSum = $invStock
                                ->where('mat_id',$item->mat_id)
                                ->where('str_loc', $item->str_loc)
                                ->where('cons_id', $item->cons_id)
                                ->sum('qty');
                        if($item->qty == $invStockSum){
                            $class = 'bg-success text-white';
                        }
                        if($item->qty != $invStockSum){
                            $class = 'bg-danger text-white';
                        }
                    ?>
                    <tr>
                        <td>{{ $item->mat_id }}</td>
                        <td>{{ $item->getMaterialInfo->name }}</td>
                        <td>{{ $item->str_loc }}</td>
                        <td>@isset($item->getConstructionSiteInfo->name)
                            {{ $item->getConstructionSiteInfo->name }}
                        @endisset</td>
                        <td class="{{ $class }}">{{ $item->qty }}</td>
                        <td class="{{ $class }}">
                            @livewire('hidroProjekt.adm.inventory-checking-inputbox',[
                                'invStock' => $invStock,
                                'item' => $item,
                                'activeInventory' => $activeInventory,
                            ], key($item->mat_id))
                        </td>
                    </tr>
                @endforeach
                @foreach ($additionalItems as $item)
                    <tr>
                        <td>{{ $item['mat_id'] }}</td>
                        <td>{{ $item['mat_name'] }}</td>
                        <td>{{ $item['str_loc'] }}</td>
                        <td>{{ $item['cons_site'] }}</td>
                        <td class="bg-danger text-white">0</td>
                        <td class="bg-danger text-white">{{ $item['qty'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
