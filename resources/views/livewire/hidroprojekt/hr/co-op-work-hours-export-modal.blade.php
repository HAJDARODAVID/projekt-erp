<div>
    <button class="btn btn-success btn-lg d-flex align-items-center mx-1" wire:click='toggleModal()'><i class="bi bi-file-earmark-spreadsheet"></i></button>

    <x-modal :show=$show :blur=TRUE :footer=FALSE>
        <x-slot name="mainTitle">Export evidencije radnih sati kooperanata</x-slot>
        <x-slot name="headerBtn">
            <button class="btn btn-dark btn-sm" wire:click='toggleModal()' wire:loading.attr='disabled'>X</button>
        </x-slot>
        <div class="px-5">
            Mjesec : {{ $month }} <br>
            Godina : {{ $year }} <br>
            <hr>
            
            <div class="px-5">
                @isset($coOpInfo)
                    @foreach ($coOpInfo as $key => $coOp)
                        @if (!($coOp['hasAtt']))
                            <div class="d-flex justify-content-between">
                                <div class="h6">{{ $coOp['name'] }}</div>
                                <div>
                                    <button class="btn btn-success btn-sm d-flex align-items-center mx-1" wire:click='exportExcel({{ $key }})'><i class="bi bi-file-earmark-spreadsheet"></i></button>
                                </div>
                            </div>
                            <hr class="py-1 my-2">
                        @endif
                    @endforeach
                @endisset
            </div>
            
        </div>
    </x-modal>
</div>
