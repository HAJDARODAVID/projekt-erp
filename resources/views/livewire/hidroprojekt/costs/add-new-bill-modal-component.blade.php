<div>
    @if ($edit)
        <div class="d-flex gap-1">
            <button class="btn btn-success btn-sm d-flex align-items-center" wire:click='modalBtn(1)'><i class="bi bi-pencil"></i></button>
            <button class="btn btn-danger btn-sm d-flex align-items-center" wire:click='deleteRow()'><i class="bi bi-trash"></i></button>
        </div>
    @else
        <button class="btn btn-success btn-lg d-flex align-items-center" wire:click='modalBtn(1)'><i class="bi bi-receipt"></i></button>
    @endif
    

    <x-modal :show='$show' :blur='TRUE'>
        @if ($edit)
            <x-slot name="mainTitle">Uređivanje računa: #{{ $bill->id }}</x-slot>
        @else
            <x-slot name="mainTitle">Dodaj novi račun</x-slot>
        @endif
        
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='modalBtn(0)' wire:loading.attr='disabled'>X</button>
        </x-slot>
        <x-slot name="footerItems">
            @if(!$edit)
                <button class="btn btn-danger" wire:loading.attr='disabled' wire:click='trashItAll()'><i class="bi bi-trash"></i></button>
            @endif
            <button class="btn btn-success" wire:loading.attr='disabled' wire:click='saveNewBill()'><i class="bi bi-floppy"></i></button>
        </x-slot>

        {{-- CONTAINER FOR SUCCESS ALERT --}}
        <div class="alert alert-success" role="alert" style="display: @if($showSuccessCard) block @else none @endif">
            Uspješno pohranjen račun!
        </div>

        {{-- FORM --}}
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="priority">Pružatelj usluga:</label>
                    <select class="form-select @isset($error['provider_id']) is-invalid  @endisset" wire:model.change='data.provider_id'>
                        @if (!$edit)
                            <option selected value="0">...</option>
                        @endif
                        @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->provider }}</option>    
                        @endforeach
                    </select>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="priority">Kategorija:</label>
                    <select class="form-select @isset($error['categories_id']) is-invalid  @endisset" wire:model.change='data.categories_id'>
                        @if (!$edit)
                            <option selected value="0">...</option>
                        @endif
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>    
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="form-group">
                    <label for="price">Iznos računa</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">€</div>
                        </div>
                        <input type="number" class="form-control @isset($error['amount']) is-invalid  @endisset" wire:model.blur='data.amount'>
                    </div>    
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="valid_to">Datum izdavanja</label>
                    <input type="date" class="form-control @isset($error['date']) is-invalid  @endisset" wire:model.blur='data.date'>
                </div>
            </div>
        </div>

        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" wire:model.live='data.inc_pdv'>
            <label class="form-check-label">
              Uključen PDV u iznosu računa
            </label>
        </div>

        <div class="form-group mt-3">
            <label for="job_description">Naponena</label>
            <textarea class="form-control" rows="4" wire:model.blur='data.remark'></textarea>
        </div>

        {{-- Loadnig spinner modal --}}
        <x-processing-modal target='saveNewBill'></x-processing-modal>

    </x-modal>
</div>
