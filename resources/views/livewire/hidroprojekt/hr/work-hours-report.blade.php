<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="row g-3">
            <div class="col" style="width: 200px">
                <label for="inputState" class="form-label"><b>Godina</b></label>
                <select id="inputState" class="form-select" wire:model.live='selectedYear'>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                </select>
              </div>
            <div class="col" style="width: 200px">
              <label for="inputState" class="form-label"><b>Mjesec</b></label>
              <select id="inputState" class="form-select" wire:model.live='selectedMonth'>
                @foreach ($months as $key => $month)
                    <option value="{{ $key }}">{{ $month }}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="d-flex gap-2">
            @livewire('hidroProjekt.hr.create-new-work-diary-from-adm')
            <x-v-divider />
            <button class="btn btn-success btn-lg d-flex align-items-center" wire:click='exportAttendanceReport()'><i class="bi bi-file-earmark-spreadsheet"></i></button>
        </div>
    </div>
    
    <hr>

    <div>
        <table class="table table-bordered" wire:loading.remove>
            <thead style="border-bottom: 1.5px solid #000000;">
                <tr>
                    <td scope="col"><b>Ime i prezime</b></td>
                    <td scope="col"><abbr title="Da li radnik zadovoljava uvjete za bonus">Bonus</abbr></td>
                    <td scope="col"><abbr title="Planirani radni sati u mjesecu">PS</abbr></td>
                    <td scope="col"><abbr title="Ostvareni radni sati u mjesecu">OS</abbr></td>
                    <td scope="col"><abbr title="Godišnji u mjesecu (dani)">GO</abbr></td>
                    <td scope="col" style="border-right: 1.5px solid #000000;"><abbr title="Bolovanja u mjesecu (dani)">BO</abbr></td>
                    @foreach ($daysOfMonth as $day)
                        <?php 
                            $daynum = date("N", strtotime($day));
                            $weekEndStyle = $daynum > 5 ? "background-color:#c9c9c9" : "";
                        ?>
                        <td scope="col" style="width: 35px;<?=$weekEndStyle?>">{{ date("d",strtotime($day)) }}</td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($completeAttendance as $worker)
                    <tr>
                        <td onclick="location.href='{{ route('hp_workerWorkHours', $worker['id']) }}';">{{ $worker['name'] }}</td>
                        <td><input class="form-check-input" type="checkbox" disabled @if ($worker['sickLeave'] == 0) checked @endif></td>
                        <td>{{ $planedHours }}</td>
                        <td>{{ $worker['monthlyHours'] }}</td>
                        <td>{{ $worker['paidLeave'] }}</td>
                        <td style="border-right: 1.5px solid #000000;">{{ $worker['sickLeave'] }}</td>
                        @isset($worker['attendance'])
                            @foreach ($worker['attendance'] as $key => $attendance)
                                <?php 
                                    $daynum = date("N", strtotime($key));
                                    $cellStyle="";
                                    if($daynum > 5) {
                                        $cellStyle="background-color:#c9c9c9"; 
                                    }
                                    if($daynum < 6 && $attendance=="" && $key< date("Y-m-d")){
                                        $cellStyle="background-color:#FF311C"; 
                                    }
                                    if($attendance!=""){
                                        $cellStyle="background-color:#38E327"; 
                                    }
                                    if($attendance=="GO"){
                                        $cellStyle="background-color:#20BBE1"; 
                                    }
                                    if($attendance=="BO"){
                                        $cellStyle="background-color:#F7AD2C"; 
                                    }
                                    if(is_int($attendance)){
                                        if($attendance>12){
                                            $cellStyle .= "; font-weight: bold;color: red;";
                                        }
                                    }
                                ?>
                                <td style="<?=$cellStyle?>" wire:click="openAttendanceModalForWorkerAndDay('{{ $worker['id'] }}', '{{ $key }}')">{{ $attendance }}</td>
                            @endforeach
                        @endisset
                    </tr>
                @endforeach
                <tr>
                    <td style="border-top: 1.5px solid #000000;"><b>Sum</b></td>
                    <td style="border-top: 1.5px solid #000000;"></td>
                    <td style="border-top: 1.5px solid #000000;">{{ $cumulative['planedHours'] }}</td>
                    <td style="border-top: 1.5px solid #000000;">{{ $cumulative['workHours'] }}</td>
                    <td style="border-top: 1.5px solid #000000;">{{ $cumulative['paidLeave'] }}</td>
                    <td style="border-top: 1.5px solid #000000; border-right: 1.5px solid #000000;">{{ $cumulative['sickLeave'] }}</td>
                    @foreach ($cumulative['dates'] as $day)
                        <td style="border-top: 1.5px solid #000000;">{{ $day }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    

    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" style="display:none" wire:loading>
            <span class="sr-only"></span>
        </div>
    </div>
      

    
</div>
