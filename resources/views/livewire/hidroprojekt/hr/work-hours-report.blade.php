<div>
    <div class="row g-3">
        <div class="col-md-3">
          <label for="inputState" class="form-label"><b>Mjesec</b></label>
          <select id="inputState" class="form-select" wire:model.live='selectedMonth'>
            @foreach ($months as $key => $month)
                <option value="{{ $key }}">{{ $month }}</option>
            @endforeach
          </select>
        </div>
    </div>
    <hr>

    <table>
        <thead>
            <tr>
                <td>Ime i prezime</td>
                <td>RR</td>
                <td>TR</td>
                @foreach ($daysOfMonth as $day)
                    <td style="width: 35px">{{ date("d",strtotime($day)) }}</td>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($completeAttendance as $worker)
                <tr>
                    <td>{{ $worker['name'] }}</td>
                    <td>160</td>
                    <td>30</td>
                    @foreach ($worker['attendance'] as $attendance)
                        <td>{{ $attendance }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    
</div>
