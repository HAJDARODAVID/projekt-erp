<div>
    <button class="btn btn-danger btn-sm" wire:click='modalToggle()'><i class="bi bi-box-arrow-right"></i></button>
    <x-modal :show=$modalShow :blur='TRUE' :footer='FALSE' size='lg'>
        <x-slot name="mainTitle">Potrošnja materijala - gradilište</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='modalToggle()' wire:loading.attr='disabled'>X</button>
        </x-slot>
        <table class="table">
            <thead>
                <tr>
                    <th>Materijal</th>
                    <th>Gradilište</th>
                    <th>Količina</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $materialInfo->name }}</td>
                    <td>{{ $constructionSiteInfo->name }}</td>
                    <td>
                        <input type="number" class="form-control form-control-sm" wire:model.blur='qty' style="width:100px">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <button class="btn btn-danger btn-lg" style="width: 100px" wire:click='sendMaterialToConsumption()'><i class="bi bi-box-arrow-right"></i></button>
        </div>
    </x-modal>
</div>
