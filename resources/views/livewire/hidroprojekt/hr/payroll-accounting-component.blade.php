<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="row g-3">
            <div class="col" style="width: 200px">
                <label for="year" class="form-label"><b>Godina</b></label>
                <select id="year" class="form-select" wire:model.live='year'>
                    <option value="">Odaberi...</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
            </div>
            <div class="col" style="width: 200px">
            <label for="month" class="form-label"><b>Mjesec</b></label>
            <select id="month" class="form-select" wire:model.live='month'>
                <option value="">Odaberi...</option>
                @foreach ($allMonths as $key => $month)
                    <option value="{{ $key }}">{{ $month }}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="d-flex gap-1">
            <button class="btn btn-primary btn-lg d-flex align-items-center" wire:click='getPayrollAccountingData()'>
                <i class="bi bi-arrow-clockwise"></i>
            </button>
            <button class="btn btn-success btn-lg d-flex align-items-center">
                <i class="bi bi-floppy"></i>
            </button>
            <button class="btn btn-success btn-lg d-flex align-items-center" wire:click='exportToExcel()'>
                <i class="bi bi-file-earmark-spreadsheet"></i>
            </button>
        </div>
    </div>
    <hr>

    @isset($data)
        <table class="table table-striped">
            <thead class="thead-light">
                <tr class="bg-secondary" style="border-bottom: 2px">
                    <th style="width: 160px">Ime i prezime</th>
                    <th style="width: 50px">OS<br>[Sati]</th>
                    <th style="width: 50px">GO<br>[Dani]</th>
                    <th style="width: 50px">BO<br>[Dani]</th>
                    <th style="width: 60px">Teren<br>[Dani]</th>
                    <th style="width: 60px;border-right: 1px solid">More<br>[Dani]</th>
                    <th style="width: 70px">Satnica</th>
                    <th style="width: 90px">Osnovnica<br>[€]</th>
                    <th style="width: 90px">Bonus<br>[{{ $bonus }}€]</th>
                    <th style="width: 90px">Teren<br>[Doma: {{ $fieldValues['home'] }}€]</th>
                    <th style="width: 100px">Teren<br>[More: {{ $fieldValues['field'] }}€]</th>
                    <th style="width: 80px">Putni<br>[€]</th>
                    <th style="width: 80px">Mobitel<br>[€]</th>
                    <th>Ukupno<br>[€]</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $worker_id => $worker)
                    <tr>
                        <td onclick="location.href='{{ route('hp_showWorker', ['id' => $worker_id, 'tab' => 2]) }}';">{{ $worker['fullName'] }}</td>
                        <td>{{ $worker['hours'] }}</td>
                        <td>{{ $worker['go'] }}</td>
                        <td>{{ $worker['bo'] }}</td>
                        <td>{{ $worker['field_1'] }}</td>
                        <td style="border-right: 1px solid">{{ $worker['field_2'] }}</td>
                        <td>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-sm" wire:model.blur='data.{{ $worker_id }}.h_rate' @if ($data[$worker_id]['fix_rate']) disabled @endif>
                            </div>
                        </td>
                        <td>{{ $worker['base'] }}</td>
                        <td>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-sm" wire:model.blur='data.{{ $worker_id }}.bonus'>
                            </div>
                        </td>

                        <td>{{ $worker['bonus_field_1'] }}</td>
                        <td>{{ $worker['bonus_field_2'] }}</td>
                        <td>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-sm" wire:model.blur='data.{{ $worker_id }}.travel_exp'>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-sm" wire:model.blur='data.{{ $worker_id }}.phone_exp'>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" style="font-weight: bold" wire:model.blur='data.{{ $worker_id }}.pay_out'>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    @endisset
    
    <x-modal :show='TRUE'>
        <x-slot name='mainTitle'>Here goes custom title</x-slot>
        {{-- <x-slot name='secTitle'>Ovo je drugi</x-slot> --}}
        <x-slot name='headerBtn'>
            <button class="btn btn-dark btn-sm">X</button>
        </x-slot>

        {{-- BODY CONTEND --}}
        “ Well begun is half done. ”<br>
        — Aristotle

        <x-slot name='footerItems'>
            <button class="btn btn-success">SAVE</button>
        </x-slot>
    </x-modal>


    @livewire('hidroProjekt.hr.payroll.change-worker-h-rate-modal')
    <x-processing-modal target='getPayrollAccountingData, data'></x-processing-modal>
</div>

