@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <div class="modal-header">
                            <span class="modal-title">Evidencija radnog dana: {{ $record->date }}</span>
                            <button class="btn btn-dark btn-sm">
                                <i class="bi bi-arrow-return-left"></i>
                            </button>
                        </div>
                    </div>   
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div id="mainBdeComponents">
                        @livewire('hidroProjekt.bde.bde-select-construction-site', [
                        'record' => $record,
                        ])
                    

                        @livewire('hidroProjekt.bde.bde-select-car',[
                            'selectedCar' => $record->car_id,
                            'record' => $record,
                            ])

                        @livewire('hidroProjekt.bde.bde-work-type-selector',[
                            'record' => $record,
                            ])
                    </div>

                    

                    @livewire('hidroProjekt.bde.bde-worker-attendance',[
                        'record' => $record,
                    ])

                    <div id="workLog" >
                        <div class="col d-flex justify-content-center"> 
                            <button class="btn btn-dark ">
                                <i class="bi bi-book"></i> DNEVNIK RADOVA
                            </button>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showAddWorkersModule(){
        document.getElementById('workLog').style.display = "none";
        document.getElementById('mainBdeComponents').style.display = "none";
        document.getElementById('attendanceComponent').style.display = "none";     
        document.getElementById('attendaceModule').style.display = "block";
    }
</script>
@endsection