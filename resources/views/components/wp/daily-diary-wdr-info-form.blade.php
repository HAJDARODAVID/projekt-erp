<div class="d-flex justify-content-center">
    <div class="col-md-9">
        <div class="d-flex justify-content-between">
            <div class="">
                <div class="h4">{{ $constSite->name }}</div>
                <div class="h6">Poslovođa: {{ $groupLeader->getWorker->firstName }} {{ $groupLeader->getWorker->lastName }}</div>
                <div class="">Adresa: {{ $constSite->street }} {{ $constSite->town }}</div>
                <div class="">Datum: {{ $wdr->date }}</div>
            </div>
            <div class="align-content-center">
                {{-- @if (!$isPhone)
                    <img src="{{ url('images/hidroprojekt_logo.png') }}"> 
                @endif --}}
                @if (!$isPhone)
                    <a href="{{ url()->previous() }}" class="btn btn-dark btn-lg"><i class="bi bi-arrow-return-left"></i></a> 
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md mb-3">
                <div class="">
                    <div class="border rounded-top p-2 shadow border-bottom-0" style="background-color: rgb(243, 243, 243)">
                        <b>Dnevnik radova:</b>
                    </div>
                    <p class="mt-3 text-break">{!! nl2br(e($stringLog)) !!}</p>
                </div>
                <div class="mb-3">
                    <div class="border rounded-top p-2 shadow border-bottom-0 mb-2" style="background-color: rgb(243, 243, 243)">
                        <b>Info vozila: @if(isset($car)) {{ $car->car_plates }} @endif</b>
                    </div>
                    <div class="mt-3 px-5">
                        <div class="d-flex justify-content-between align-content-start">
                            <div class="">
                                <b>Marka:</b> @if(isset($car)) {{ $car->brand }} @endif <br>
                                <b>Model:</b> @if(isset($car)) {{ $car->model }} @endif <br>
                            </div>
                            <div class="">
                                <b>Početno stanje(km):</b> @if(isset($carMileage)) {{ $carMileage->start_mileage }} @endif<br>
                                <b>Završno stanje(km):</b> @if(isset($carMileage)) {{ $carMileage->end_mileage }} @endif<br>
                                <b>Pređeno(km):</b>  @if(isset($carMileage)){{ $carMileage->end_mileage - $carMileage->start_mileage }} @endif<br>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="">
                    <div class="border rounded-top p-2 shadow border-bottom-0 mb-2" style="background-color: rgb(243, 243, 243)">
                        <b>Utrošeni materijal:</b>
                    </div>
                    @livewire('hidroProjekt.Wp.construction-site-consumption-table',[
                        'theme' => 'bootstrap-5',
                        'wdrId' => $wdr->id
                    ])
    
                </div>
            </div>
            
            <div class="col-md">
                <div class="">
                    <div class="border rounded-top p-2 shadow border-bottom-0 mb-2" style="background-color: rgb(243, 243, 243)">
                        <div class="d-flex justify-content-between">
                            <b>Prisustvo radnika:</b>
                            @livewire('domain.attendance.add-workers-to-report-btn',[
                                'wdr' => $wdr
                            ])
                        </div>
                    </div>
                    <div class="mt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                <td><b>Ime, prezime</b></td>
                                <td><b>Sati</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $att)
                                <tr>
                                    <td>{{ $att->getWorkerInfo->firstName }} {{ $att->getWorkerInfo->lastName }}</td>
                                    <td>
                                        @if ($att->work_hours) 
                                            {{ $att->work_hours }} 
                                        @else
                                            @if ($att->absence_reason) {{ $arst[$att->absence_reason]}} @endif   
                                        @endif        
                                    </td> 
                                </tr>  
                                @endforeach
                                @foreach ($attendanceCoOp as $attCoOp)
                                    <tr>
                                        <td>{{ $attCoOp->getWorkerInfo->firstName }} {{ $attCoOp->getWorkerInfo->lastName }} [{{ $attCoOp->getWorkerInfo->getCoOpInfo->name }}]</td>
                                        <td>{{ $attCoOp->work_hours }}</td> 
                                    </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>  
    

</div>