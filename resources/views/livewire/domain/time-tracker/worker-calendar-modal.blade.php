<div>
    <x-modal :customWidth="1600" :show=$show :blur=TRUE>
        <x-slot:mainTitle>@isset($workerInfo) #{{ sprintf('%04d', $workerInfo->id) }} | {{ $workerInfo->fullName }} @endisset</x-slot:mainTitle>
        <x-slot:secTitle>@isset($workerInfo){{ $workerInfo->working_place }}@endisset</x-slot:secTitle>
        <x-slot:headerBtn>
            <div class="d-flex gap-1">
                @if (count($selectedDates) == 1)
                    <button class="btn btn-success btn-sm shadow" wire:click='showModalForDay()'><i class="bi bi-calendar-day"></i></button>  
                @endif
                <x-v-divider />
                <button class="btn btn-dark btn-sm shadow" wire:click='closeModal()'>X</button>
            </div>
        </x-slot:headerBtn>

        <div class="d-flex justify-content-center">
            @foreach (App\Services\Days::DAY_NAME_HR as $day)
                <x-calendar.cell-basic :data="['day' => $day,'header'=>TRUE]" h=40 w=210/>
            @endforeach
        </div> 
        @isset($attendanceData)
            @foreach ($attendanceData as $cw => $dates)
                <div class="row">
                    <div class="d-flex justify-content-center">
                        @foreach ($dates as $date)
                            @isset ($param)
                                <x-calendar.cell-basic :data="['cellData' => $date, 'month' => $param['month'], 'year' => $param['year']]" :selected="IsCell::selected($selectedDates, $date['date']->format('Y-m-d'))" w=210 h=130/>
                            @endisset
                        @endforeach  
                    </div> 
                </div> 
            @endforeach    
        @endisset

        {{ var_export($selectedDates) }}
        
    </x-modal>

    <div class="roe"></div>
</div>
