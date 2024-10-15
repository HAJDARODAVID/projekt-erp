<div class="">
    <div class="rounded shadow border p-3">
        <div class="d-flex align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:45px">
            <div class="h5 px-4"><b>PRODAJA MATERIJALA</b></div>
        </div>
        <div class="row">
            <div class="col-md-4 p-3">
                <div class="alert alert-light m-0 mb-4 shadow">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Kupca</label>
                        <input type="text" class="form-control @isset($error['buyer']) is-invalid @endisset" wire:model.blur='data.buyer'>
                    </div>
                    <hr class="m-0 my-2">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Način plaćanja</label>
                        <select class="form-control" wire:model.change='data.pymt_method'>
                            @foreach ($t_type as $t_Key => $type)
                                <option value="{{ $t_Key }}">{{ $type }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3 mx-2">
                        <label for="">Status plaćanja</label>
                        <select class="form-control" wire:model.change='data.pymt_status'>
                            @foreach ($p_status as $s_Key => $status)
                                <option value="{{ $s_Key }}">{{ $status }}</option> 
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="alert alert-light m-0 shadow">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Ukupni iznos</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">€</div>
                            </div>
                            <input type="number" class="form-control"  disabled wire:model='totalAmount'>
                        </div>  
                    </div>
                    
                    <hr class="m-0 my-2">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Datum</label>
                        <input type="date" class="form-control @isset($error['date']) is-invalid @endisset" wire:model.change='data.date'>
                    </div>
                    <div class="d-flex justify-content-center mb-3 mx-2 ">
                        <button class="btn btn-dark btn-lg shadow" style="width: auto" wire:click='createNewOrder()'>KREIRAJ NALOG</button>
                    </div>    
                </div>
            </div>
            <div class="col-md p-3">
                <div class="alert alert-light shadow m-0" style="height: 700px">
                    <div class="d-flex mb-2">
                        <div class="form-group mb-2 mx-2" style="width: 250px" >
                            <input type="number" class="form-control" placeholder="Br. materijala" wire:model.blur='matInput'>
                        </div>
                        <button class="btn btn-success align-items-center" style="height: 38px" wire:click='toggleAddMaterialModal()'>
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                    <hr class="m-0 my-2">
                    <div class="overflow-auto" style="height: 600px">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Naziv proizvoda</th>
                                    <th>Kol.</th>
                                    <th>Cijena[€]</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($receiptItems as $mat_id => $item)
                                <tr>
                                    <td>{{ $mat_id }}</td>
                                    <td>{{ $item['mat_name'] }}</td>
                                    <td><input type="number" class="form-control form-control-sm" style="width: 70px" wire:model.blur='receiptItems.{{ $mat_id }}.s_qty'></td>
                                    <td><input type="number" class="form-control form-control-sm" style="width: 100px" wire:model.blur='receiptItems.{{ $mat_id }}.s_amount'></td>
                                    <td><button class="btn btn-danger btn-sm align-items-center" wire:click='removeItem({{ $mat_id }})'><i class="bi bi-x-circle"></i></button></td>
                                </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <x-modal :show=$addMaterialModalShow :blur=TRUE size='lg'>
        <x-slot name="mainTitle">Proizvodi na stanju skladišta</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='toggleAddMaterialModal()' wire:loading.attr='disabled'>X</button>
        </x-slot>
        @livewire('hidroProjekt.sales.available-materials-table', [
                    'theme' => "bootstrap-5"])
    </x-modal>
</div>