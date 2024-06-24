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
            <button class="btn btn-success btn-lg d-flex align-items-center">
                <i class="bi bi-file-earmark-spreadsheet"></i>
            </button>
        </div>
    </div>
    <hr>

    @isset($data)
        <table class="table table-striped">
            <thead class="thead-light">
                <tr class="bg-secondary" style="border-bottom: 2px">
                    <th scope="col" style="width: 180px">Ime i prezime</th>
                    <th scope="col" style="width: 60px">OS</th>
                    <th scope="col" style="width: 60px">GO</th>
                    <th scope="col" style="width: 60px">BO</th>
                    <th scope="col" style="width: 60px">Teren<br>[Dani]</th>
                    <th scope="col" style="width: 60px;border-right: 1px solid">More<br>[Dani]</th>
                    <th style="width: 70px">Satnica</th>
                    <th style="width: 110px">Osnovnica<br>[€]</th>
                    <th style="width: 100px">Bonus<br>[{{ $bonus }}€]</th>
                    <th style="width: 100px">Teren<br>[Doma: {{ $fieldValues['home'] }}€]</th>
                    <th style="width: 100px">Teren<br>[More: {{ $fieldValues['field'] }}€]</th>
                    <th style="width: 100px">Putni<br>[€]</th>
                    <th style="width: 100px">Mobitel<br>[€]</th>
                    <th>Ukupno<br>[€]</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $worker_id => $worker)
                    <tr>
                        <td>{{ $worker['fullName'] }}</td>
                        <td>{{ $worker['hours'] }}</td>
                        <td>{{ $worker['go'] }}</td>
                        <td>{{ $worker['bo'] }}</td>
                        <td>{{ $worker['field_1'] }}</td>
                        <td style="border-right: 1px solid">{{ $worker['field_2'] }}</td>
                        <td>{{ $worker['h_rate'] }}</td>
                        <td>{{ number_format($worker['base'], 2, ',', '.') }}</td>
                        <td>{{ number_format($worker['bonus'], 2, ',', '.') }}</td>
                        <td>{{ number_format($worker['bonus_field_1'], 2, ',', '.') }}</td>
                        <td>{{ number_format($worker['bonus_field_2'], 2, ',', '.') }}</td>
                        <td>{{ number_format(0, 2, ',', '.') }}</td>
                        <td>{{ number_format(0, 2, ',', '.') }}</td>
                        <td><b>{{ number_format($worker['pay_out'], 2, ',', '.') }}</b></td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    @endisset

    <x-processing-modal target='getPayrollAccountingData'></x-processing-modal>
</div>
