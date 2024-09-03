<div>
    <x-modal  :show=$showModal :blur="TRUE"
    >
        <x-slot name="mainTitle">@isset($matInfo){{ $matInfo->id}} @endisset </x-slot>
        <x-slot name="secTitle">@isset($matInfo){{ $matInfo->name}} @endisset </x-slot>


    </x-modal>
</div>
