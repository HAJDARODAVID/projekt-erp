<div>
    <button class="btn btn-warning btn-lg d-flex align-items-center" wire:click='openCloseModal()' @if (!$payroll) disabled @endif>
        <i class="bi bi-person-dash"></i>
    </button>

    <x-modal :show='$show'>
        <x-slot name='mainTitle'>Odbici radnika</x-slot>
        <x-slot name='secTitle'>Mjesec: @if ($payroll) {{ $month[$payroll['month']] }} @endif</x-slot>

        <x-slot name='headerBtn'>
            <button class='btn btn-dark btn-sm' wire:click='openCloseModal()'>X</button>
        </x-slot>
        
        {{-- BODY CONTEND --}}

        <table>
            <thead>
                <tr>
                    <th>Radnik</th>
                    <th style="width: 80px">Iznos</th>
                    <th>Razlog</th>
                </tr>
            </thead>
            <tbody>
                @isset($deductions)
                    @foreach ($deductions as $key => $data )
                        <tr>
                            <td>
                                <select class="form-control form-control-sm" wire:model.change='deductions.{{ $key }}.worker_id' @if ($locked) disabled @endif>
                                    <option value="0">...</option> 
                                    @isset($workers)
                                        @foreach ($workers as $worker)
                                            <option value="{{ $worker->id }}">{{ $worker->fullName }}</option>    
                                        @endforeach
                                    @endisset
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control form-control-sm" wire:model.blur='deductions.{{ $key }}.amount' @if ($locked) disabled @endif>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" wire:model.blur='deductions.{{ $key }}.reason' @if ($locked) disabled @endif>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" wire:click='deleteBtn("{{ $key }}")' @if ($locked) disabled @endif><i class='bi bi-trash'></i></button>
                            </td>
                        </tr>
                    @endforeach  
                @endisset
                
            </tbody>
        </table>
        @isset($deductions)
            <button class='btn btn-success btn-sm mt-1' wire:click='addItems()' @if ($locked) disabled @endif>+</button>
        @endisset
        
        <x-slot name='footerItems'>
            <button class='btn btn-success' wire:click='saveBtn()' @if ($locked) disabled @endif>
                <i class="bi bi-floppy"></i>
            </button>
        </x-slot>
    </x-modal>
</div>
