<div class="d-flex justify-content-center">
    <div class="col-md-7">
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
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md mb-3">
                <div class="">
                    <div class="border rounded-top p-2 shadow border-bottom-0" style="background-color: rgb(243, 243, 243)">
                        <b>Dnevnik radova:</b>
                    </div>
                    <p class="mt-2 text-break">{!! nl2br(e($stringLog)) !!}</p>
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
                <div class="border rounded-top p-2 shadow border-bottom-0 mb-2" style="background-color: rgb(243, 243, 243)">
                    <b>Prisustvo radnika:</b>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                        <td><b>Ime i prezime</b></td>
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
                                    @if ($att->absence_reason)
                                        {{ $arst[$att->absence_reason]}}
                                    @endif   
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