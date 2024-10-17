<div>
    <button class="btn btn-success btn-lg d-flex align-items-center" wire:click='toggleModal()'><i class="bi bi-file-earmark-spreadsheet"></i></button>

    <x-modal :show=$show :blur=TRUE :footer=FALSE>
        <x-slot name="mainTitle">Odaberi mjesec:</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='toggleModal(0)' wire:loading.attr='disabled'>X</button>
        </x-slot>
        <div class="d-flex gap-3">
            <select class="form-control form-control-sm" wire:model.change='month'>
                @foreach ($months as $key => $month)
                    <option value="{{ $key }}">{{ $month }}</option>     
                @endforeach
                
            </select>
            <button class="btn btn-success d-flex align-items-center" wire:click='exportReport()'><i class="bi bi-file-earmark-spreadsheet"></i></button>
        </div>
    </x-modal>
</div>
