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
                                <th>Materijal</th>
                                <th>Kol.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mainData['orderItems'] as $item)
                                <tr>
                                    <td>{{ $item['mat_name'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="mt-3 text-break">{!! nl2br(e($mainData['remark'])) !!}</p>
                    @break
            
                @default    
            @endswitch
        @endisset
    </x-modal>
</div>
