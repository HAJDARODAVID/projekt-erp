<div>
    <div class="row g-3">
        <div class="col" style="width: 200px">
            <label for="year" class="form-label"><b>Godina</b></label>
            <select id="year" class="form-select" wire:model.live='year'>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
        <div class="col" style="width: 200px">
        <label for="month" class="form-label"><b>Mjesec</b></label>
        <select id="month" class="form-select" wire:model.live='month'>
            @foreach ($allMonths as $key => $monthName)
                <option value="{{ $key }}">{{ $monthName }}</option>
            @endforeach
        </select>
        </div>
    </div>
    <hr>

    <div class="container">
        <div class="row">
            <div class="col">
                <p class="text-primary mb-0"><b>Radni sati:</b></p>
                <p class="text-primary"><b>{{ $basicInfo['hours'] }}</b></p>
            </div>
            <div class="col">
                <p class="text-primary mb-0"><b>GO:</b></p>
                <p class="text-primary"><b>{{ $basicInfo['GO'] }}</b></p>
            </div>
            <div class="col">
                <p class="text-primary mb-0"><b>BO:</b></p>
                <p class="text-primary"><b>{{ $basicInfo['BO'] }}</b></p>
            </div>
        </div>
        @foreach ($data as $cw => $week )
            <div class="row gap-1 mb-1">
                @foreach ($week as $day => $info)
                    <?php 
                        $bgStyle = 'rgb(241, 241, 241)';
                        if((date('m', strtotime($day))*1) != $month){
                            $bgStyle = 'rgb(224, 224, 224)';
                        }
                    ?>
                    <div class="col py-2" style="background-color: {{ $bgStyle }}">
                        <div class="d-flex justify-content-center"><b>{{ $info['day_sht'] }}</b></div>
                        <div class="d-flex justify-content-center"><span style="font-size:12px">{{ date('d-m', strtotime($day)) }}</span></div>
                        <hr class="my-1 d-flex justify-content-center">
                        <span style="font-size:17px" class="d-flex justify-content-center">
                            <b>
                                {{ $info['att']}}
                                @if(is_float($info['att']))h                                    
                                @endif
                            </b>
                        </span>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
