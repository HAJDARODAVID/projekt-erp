<div class="">
    <div class="rounded shadow border p-3">
        {{-- HEADER CARD --}}
        <div class="d-flex align-items-center rounded-top shadow mb-2" style="background-color: rgb(236, 236, 236);height:45px">
            <div class="h5 px-4"><b>EVIDENCIJA RADNIH SATI</b></div>
        </div>
        
        <div class="px-3">
            {{-- OPTION / MENU BAR --}}
            <div class="row">
                <div class="col-md-1 pt-2">
                    <label class="form-label">Godina</label>
                    <select class="form-select form-select-sm" wire:model.live='selYear'>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>    
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 pt-2">
                    <label class="form-label">Mjesec</label>
                    <select class="form-select form-select-sm" wire:model.live='selMonth'>
                        @foreach ($months as $mKey => $month)
                            <option value="{{ $mKey }}">{{ $month }}</option>    
                        @endforeach
                    </select>
                </div>
                <div class="col-md align-content-end pt-3">
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-success"> <i class="bi bi-floppy"></i> </button>
                        <x-v-divider />
                        <button class="btn btn-success"> <i class="bi-file-earmark-spreadsheet"></i> </button>
                    </div>   
                </div>
            </div>
            <hr>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <x-table.time-tracker-table.th  name='radnik' :width='170' :center=FALSE borderStyle='bb.5.double.gray'  :sticky=FALSE /> 
                            <x-table.time-tracker-table.th  name='BONUS' :width='33' borderStyle='bb.5.double.gray-bl.1.solid.gray' />
                            <x-table.time-tracker-table.th  name='PS' :width='33' borderStyle='bb.5.double.gray-bl.1.solid.gray' />
                            <x-table.time-tracker-table.th  name='OS' :width='33' borderStyle='bb.5.double.gray-bl.1.solid.gray' />
                            <x-table.time-tracker-table.th  name='GO' :width='33' borderStyle='bb.5.double.gray-bl.1.solid.gray' />
                            <x-table.time-tracker-table.th  name='bo' :width='33' borderStyle='bb.5.double.gray-br.5.double.gray-bl.1.solid.gray' />
                            @foreach ($days as $day)
                                <x-table.time-tracker-table.th  
                                    :pointer=TRUE
                                    date='{{ $day }}'
                                    name='{{ date("d",strtotime($day))  }}' 
                                    :width='33' 
                                    borderStyle='bb.5.double.gray-bl.1.solid.gray'/>   
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $workerID => $worker)
                            <tr>
                                {{-- WORKER NAME --}}
                                <x-table.time-tracker-table.td :center=FALSE :sticky=FALSE> 
                                    <x-slot:value>
                                        <span class="d-inline-block text-truncate" style="max-width: 150px;">{{ $worker["fullName"] }}</span>
                                    </x-slot:value>
                                </x-table.time-tracker-table.td>
                                {{-- BONUS --}}
                                <x-table.time-tracker-table.td borderStyle='bl.1.solid.gray' > 
                                    <x-slot:value>
                                        <input type="checkbox" disabled @if($worker["sick_leave"] == 0) checked @endif>
                                    </x-slot:value>
                                </x-table.time-tracker-table.td>
                                {{-- PLANED HOURS --}}
                                <x-table.time-tracker-table.td value='{{ $worker["planed_hours"] }}' borderStyle='bl.1.solid.gray' />
                                {{-- OVERALL HOURS --}}
                                <x-table.time-tracker-table.td value='{{ $worker["hours_overall"] }}' borderStyle='bl.1.solid.gray' />
                                {{-- PAID LEAVE --}}
                                <x-table.time-tracker-table.td value='{{ $worker["paid_leave"] }}' borderStyle='bl.1.solid.gray'  />
                                {{-- SICK LEAVE --}}
                                <x-table.time-tracker-table.td value='{{ $worker["sick_leave"] }}' borderStyle='bl.1.solid.gray-br.5.double.gray' />
                                {{-- DATA PER DAY --}}
                                @foreach ($worker['days'] as $day => $value)
                                    <x-table.time-tracker-table.td 
                                        :pointer=TRUE
                                        type='hours'
                                        date='{{ $day }}'
                                        :value='$value'
                                        :bl="[1,'solid','rgb(192,195,199)']" 
                                        :wireClick='[
                                            "method" => "showModalForDay", 
                                            "param" => "date.$day,workerID.$workerID"
                                        ]'/> 
                                @endforeach 
                            </tr>  
                        @endforeach
                    </tbody>
                </table>   
            </div>
            
        </div>
        
    </div>
</div>
