<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="row g-3">
            <div class="col-md-2" style="width: 200px">
                <label for="inputState" class="form-label"><b>Godina</b></label>
                <select id="inputState" class="form-select" wire:model.live='selectedYear'>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                </select>
                </div>
            <div class="col-md-2" style="width: 200px">
                <label for="inputState" class="form-label"><b>Mjesec</b></label>
                <select id="inputState" class="form-select" wire:model.live='selectedMonth'>
                @foreach ($months as $key => $month)
                    <option value="{{ $key }}">{{ $month }}</option>
                @endforeach
                </select>
            </div>
        </div>
        @livewire('hidroprojekt.hr.co-op-work-hours-export-modal', [
            'year' => $s_year,
            'month' => $s_month,
            ], key('modal'.now()))
    </div>
    <hr>

    <div>
        <table class="table table-bordered" wire:loading.remove >
            <thead style="border-bottom: 1.5px solid #000000;">
                <tr>
                    <td scope="col"><b>Ime i prezime</b></td>
                    <td scope="col"><abbr title="Ostvareni radni sati u mjesecu">OS</abbr></td>
                    <td scope="col" style="border-right: 1.5px solid #000000;"><abbr title="Trošak kooperanata">€</abbr></td>
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
                @foreach ($attendance['workerAttendance'] as $groupName => $group)
                    <?php 
                        $overAllGroup=0;
                        $overAllGroupCost=0;
                    ?>
                    @foreach ($group as $attInfo)
                        <?php 
                            $overAllGroup += $attInfo['overall'];
                            $overAllGroupCost += $attInfo['cost'];
                        ?>
                        <tr>
                            <td>{{ $attInfo['name'] }}</td>
                            <td>{{ $attInfo['overall'] }}</td>
                            <td style="border-right: 1.5px solid #000000;">{{ number_format($attInfo['cost'], 2) }}€</td>
                            @foreach ($attInfo['dates'] as $key => $day)
                                <?php 
                                    $daynum = date("N", strtotime($key));
                                    $cellStyle="";
                                    if($daynum > 5) {
                                        $cellStyle="background-color:#c9c9c9"; 
                                    }
                                ?>
                                <td style="<?=$cellStyle?>" wire:click="openAttendanceModalForWorkerAndDay('{{ $attInfo['id'] }}', '{{ $key }}')">{{ $day }}</td>  
                            @endforeach
                        </tr>   
                    @endforeach
                    <tr style="background-color:#c9c9c9">
                        <td><b>{{ $groupName }}</b></td>
                        <td><b>{{  $overAllGroup }}</b></td>
                        <td style="border-right: 1.5px solid #000000;"><b>{{  number_format($overAllGroupCost,2) }}€</b></td>
                        @foreach ($attendance['groupPerDay'][$groupName] as $days)
                            <td><b>{{ $days }}</b></td>
                        @endforeach
                    </tr>
                @endforeach
                <tr>
                    <td style="border-top: 1.5px solid #000000;"><b>Sum</b></td>
                    <td style="border-top: 1.5px solid #000000;"><b>{{ array_sum($attendance['sumPerDay']) }}</b></td>
                    <td style="border-top: 1.5px solid #000000;border-right: 1.5px solid #000000;"><b>{{ number_format($attendance['overAllCost'], 2) }}€</b></td>
                    @foreach ($attendance['sumPerDay'] as $key => $day)
                            <?php 
                                $daynum = date("N", strtotime($key));
                                $cellStyle="";
                                if($daynum > 5) {
                                    $cellStyle="background-color:#c9c9c9"; 
                                }
                            ?>
                        <td style="border-top: 1.5px solid #000000;<?=$cellStyle?>"><b>{{ $day }}</b></td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" style="display:none" wire:loading >
            <span class="sr-only"></span>
        </div>
    </div>

    <x-processing-modal target='openAttendanceModalForWorkerAndDay'></x-processing-modal>

</div>
