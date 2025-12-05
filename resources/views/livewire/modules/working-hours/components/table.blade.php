<div class="p-3 pt-0" style="position: absolute;top: 0; right: 0; bottom: 0; left: 0; margin-top: 10px;margin-bottom: 10px; overflow-y: auto">
    <table class="table table-responsive">
        <thead>
            <tr>
                <th></th>
                @foreach ($data->getDates() as $date)
                    <th>{{ $date->format('d') }}</th>
                @endforeach
                
            </tr>
        </thead>
        <tbody>
            @foreach ($data->getWorkers() as $id => $worker)
                <tr>
                    <td>
                        <div class="d-flex gap-2">
                            <div class="">{{ str_pad($id, 3, '0', STR_PAD_LEFT) }}</div>
                            <x-v-divider px=0 />
                            <div class="">{{ $worker['name'] }}</div>
                        </div>
                    </td>
                    @foreach ($data->getDates() as $date)
                        <td>{{ $data->date($date)->worker($id)->attendance() }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
