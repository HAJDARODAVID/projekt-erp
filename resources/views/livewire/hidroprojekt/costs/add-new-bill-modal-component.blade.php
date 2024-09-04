<div>
    <button class="btn btn-success btn-lg d-flex align-items-center" wire:click='modalBtn(1)'><i class="bi bi-receipt"></i></button>

    <x-modal :show='$show' :blur='TRUE'>
        <x-slot name="mainTitle">Dodaj novi račun</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='modalBtn(0)' wire:loading.attr='disabled'>X</button>
        </x-slot>
        <x-slot name="footerItems">
            <button class="btn btn-danger" wire:loading.attr='disabled' wire:click='trashItAll()'><i class="bi bi-trash"></i></button>
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
                    <select class="form-select @isset($error['provider']) is-invalid  @endisset" wire:model.change='data.provider'>
                        <option selected value="0">...</option>
                        @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->provider }}</option>    
                        @endforeach
                    </select>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="priority">Kategorija:</label>
                    <select class="form-select @isset($error['category']) is-invalid  @endisset" wire:model.change='data.category'>
                        <option selected value="0">...</option>
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
                        <input type="number" class="form-control @isset($error['amount']) is-invalid  @endisset" wire:model.change='data.amount'>
                    </div>    
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="valid_to">Datum izdavanja</label>
                    <input type="date" class="form-control @isset($error['date']) is-invalid  @endisset" wire:model.change='data.date'>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <label for="job_description">Naponena</label>
            <textarea class="form-control" rows="4" wire:model.change='data.remark'></textarea>
        </div>

        {{-- Loadnig spinner modal --}}
        <x-processing-modal target='saveNewBill'></x-processing-modal>

    </x-modal>
</div>
