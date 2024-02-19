<div>
    <div class="row g-3">
        <div class="col-md-2">
            <label for="inputState" class="form-label"><b>Godina</b></label>
            <select id="inputState" class="form-select" wire:model.live='selectedYear'>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
            </select>
          </div>
        <div class="col-md-2">
          <label for="inputState" class="form-label"><b>Mjesec</b></label>
          <select id="inputState" class="form-select" wire:model.live='selectedMonth'>
            @foreach ($months as $key => $month)
                <option value="{{ $key }}">{{ $month }}</option>
            @endforeach
          </select>
        </div>
    </div>
    <hr>

    <div>
        <table class="table table-bordered" wire:loading.remove>
            <thead style="border-bottom: 1.5px solid #000000;">
                <tr>
                    <td scope="col"><b>Ime i prezime</b></td>
                    <td scope="col" style="border-right: 1.5px solid #000000;"><abbr title="Ostvareni radni sati u mjesecu">OS</abbr></td>
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
                @foreach ($attendance['workerAttendance'] as $attInfo)
                    <tr>
                        <td>{{ $attInfo['name'] }}</td>
                        <td style="border-right: 1.5px solid #000000;"></td>
                        @foreach ($attInfo['dates'] as $key => $day)
                            <?php 
                                $daynum = date("N", strtotime($key));
                                $cellStyle="";
                                if($daynum > 5) {
                                    $cellStyle="background-color:#c9c9c9"; 
                                }
                            ?>
                            <td style="<?=$cellStyle?>">{{ $day }}</td>  
                        @endforeach
                    </tr>
                @endforeach
                <tr>
                    <td style="border-top: 1.5px solid #000000;"><b>Sum</b></td>
                    <td style="border-top: 1.5px solid #000000;"></td>
                    @foreach ($attendance['sumPerDay'] as $day)
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
