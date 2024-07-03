<div>
    <x-modal :show='TRUE' :alert='TRUE' size='sm'>
        <x-slot name='mainTitle'>Here goes custom title</x-slot>
        {{-- <x-slot name='secTitle'>Ovo je drugi</x-slot> --}}
        <x-slot name='headerBtn'>
            <button class='btn btn-dark btn-sm'>X</button>
        </x-slot>

        {{-- BODY CONTEND --}}
        “ Well begun is half done. ”<br>
        — Aristotle

        <x-slot name='footerItems'>
            <button class='btn btn-success'>SAVE</button>
        </x-slot>
    </x-modal>
</div>
