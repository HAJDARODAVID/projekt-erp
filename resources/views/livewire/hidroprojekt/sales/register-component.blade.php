<div class="">
    <div class="rounded shadow border p-3">
        <div class="d-flex align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:45px">
            <div class="h5 px-4"><b>INTERNA BLAGAJNA</b></div>
        </div>
        <div class="row">
            <div class="col-md-4 p-3">
                <div class="alert alert-light m-0 mb-4 shadow">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Kupca</label>
                        <input type="text" class="form-control">
                    </div>
                    <hr class="m-0 my-2">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Način plačanja</label>
                        <input type="text" class="form-control" placeholder="Kupac">
                    </div>
                    <div class="form-group mb-3 mx-2">
                        <label for="">Status plačanja</label>
                        <input type="text" class="form-control" placeholder="Kupac">
                    </div>
                </div>
                <div class="alert alert-light m-0 shadow">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Ukupni iznos</label>
                        <input type="number" class="form-control"  disabled wire:model='totalAmount'>
                    </div>
                    <hr class="m-0 my-2">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Datum</label>
                        <input type="text" class="form-control" placeholder="Kupac">
                    </div>
                    <div class="d-flex justify-content-center mb-3 mx-2 ">
                        <button class="btn btn-dark btn-lg shadow" style="width: auto">IZRADI RAČUN</button>
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
                                    <th>Cijena</th>
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
                                    <td><button class="btn btn-danger btn-sm align-items-center"><i class="bi bi-x-circle"></i></button></td>
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