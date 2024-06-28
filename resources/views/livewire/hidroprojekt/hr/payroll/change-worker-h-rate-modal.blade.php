<x-modal :show='$showModal'>
    <x-slot name='mainTitle'>Promjena satnice radnika</x-slot>

    {{-- BODY CONTEND --}}
    @isset($worker)
        Da li želite promjeniti satnicu u matičnim podacima: <br>
        Radnik: {{ $worker->fullName }} <br>
        Promjena: 
        @if (is_null($worker->getWorkerBasicPayrollInfo->h_rate))
            {{ number_format(0,2) }}
        @else
            {{ $worker->getWorkerBasicPayrollInfo->h_rate }}
        @endif
        --> {{ number_format($newValue,2) }}
    @endisset

    <x-slot name='footerItems'>
        <button class="btn btn-success" wire:click='changeBtn(1)'>PROMJENI</button>
        <button class="btn btn-primary" wire:click='changeBtn()'>ZADRŽI SAMO ZA OBRAČUN</button>
    </x-slot>
</x-modal>