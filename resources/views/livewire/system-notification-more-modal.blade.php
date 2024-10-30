<div>
    <x-modal :show=$show :blur=TRUE>
        <x-slot name="mainTitle">{{ strtoupper($title) }}</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='toggleModal()' wire:loading.attr='disabled'>X</button>
        </x-slot>
        
        @isset($this->data['type'])
            @switch($this->data['type'])
                @case('int_order')
                    {{-- SECONDARY TITLE --}}
                    <x-slot name='secTitle'>
                        Poslovođa: {{ $mainData['orderedBy'] }} <br>
                        Gradilište: {{ $mainData['jobSiteName'] }} <br>
                    </x-slot>
                    {{-- BODY --}}
                    
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Materijal</th> <th>Kol.</th> <th>Mj.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mainData['orderItems'] as $item)
                                <tr>
                                    <td>{{ $item['mat_name'] }}</td> <td>{{ $item['qty'] }}</td> <td>{{ $item['uom'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md rounded shadow border px-0" style="background-color: rgb(252, 252, 252)">
                        <div class="d-flex justify-content-between align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:40px">
                            <div class="h7 px-4" style="color: rgb(102, 121, 146)">
                                <b>{{ strtoupper("napomena radnika") }}</b>
                            </div>
                        </div>
                        <div class="py-1 px-4 overflow-auto">
                            <p class="mt-3 text-break">{!! nl2br(e($mainData['remark'])) !!}</p>
                        </div> 
                    </div>
                    @break
            
                @default    
            @endswitch
        @endisset
    </x-modal>
</div>
