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
                    <tr>
                        <td>{{ $item->mat_id }}</td>
                        <td>{{ $item->getMaterialInfo->name }}</td>
                        <td>{{ $item->str_loc }}</td>
                        <td>@isset($item->getConstructionSiteInfo->name)
                            {{ $item->getConstructionSiteInfo->name }}
                        @endisset</td>
                        <td>{{ $item->qty }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
