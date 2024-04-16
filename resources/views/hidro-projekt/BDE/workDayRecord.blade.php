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
                            <a class="btn btn-dark btn-sm" style="display:none" id="goToMainModul" href="{{ route('hp_workingDayEntry',$record->id) }}">
                                <i class="bi bi-arrow-return-left"></i>
                            </a>
                            <a class="btn btn-dark btn-sm" style="display:block" id="goToHome" href="{{ route('home') }}">
                                <i class="bi bi-arrow-return-left"></i>
                            </a>
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

                    @livewire('hidroProjekt.bde.bde-cooperators-attendance',[
                        'record' => $record,
                    ])

                    @livewire('hidroProjekt.bde.bde-working-day-log',[
                        'record' => $record,
                    ])

                    @if ($modules['bde-mc'] && $record->construction_site_id)
                        <div class="col d-flex justify-content-center mt-2"> 
                            <a href="{{ route('hp_consSiteMaterialConsumption', [$record->id,$record->construction_site_id]) }}" class="btn btn-success" style="width: 175px"><i class="bi bi-cone-striped"></i> MATERIJAL</a> 
                        </div>
                    @endif
                    
                    

                    <div id="deleteEntry" class="mt-2">
                        <div class="col d-flex justify-content-center"> 
                            <button class="btn btn-danger " onclick="deleteEntryConfirmation ()" style="width: 175px">
                                <i class="bi bi-trash"></i> OBRIŠI ZAPIS
                            </button>
                        </div>
                        <form action="{{route('hp_deleteWorkingDayEntry', $record->id)}}" method="POST" id="deleteThisEntry">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="delete" value="true">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showAddWorkersModule(){
        document.getElementById('goToHome').style.display = "none";
        document.getElementById('workLog').style.display = "none";
        document.getElementById('mainBdeComponents').style.display = "none";
        document.getElementById('attendanceComponent').style.display = "none";     
        document.getElementById('attendaceModule').style.display = "block";
        document.getElementById('goToMainModul').style.display = "block";
        document.getElementById('deleteEntry').style.display = "none";
        document.getElementById('cooperatorsComponent').style.display = "none"; 
        document.getElementById('cooperatorsModule').style.display = "none"; 
    }

    function showAddCooperatorsModule(){
        document.getElementById('goToHome').style.display = "none";
        document.getElementById('workLog').style.display = "none";
        document.getElementById('mainBdeComponents').style.display = "none";
        document.getElementById('attendanceComponent').style.display = "none";     
        document.getElementById('attendaceModule').style.display = "none";
        document.getElementById('goToMainModul').style.display = "block";
        document.getElementById('deleteEntry').style.display = "none";
        document.getElementById('cooperatorsComponent').style.display = "none";
        document.getElementById('cooperatorsModule').style.display = "block";   
    }

    function showWorkLogModule(){
        document.getElementById('goToHome').style.display = "none";
        document.getElementById('workLog').style.display = "none";
        document.getElementById('mainBdeComponents').style.display = "none";
        document.getElementById('attendanceComponent').style.display = "none";     
        document.getElementById('goToMainModul').style.display = "block";
        document.getElementById('deleteEntry').style.display = "none"; 
        document.getElementById('workLogForm').style.display = "block";
        document.getElementById('cooperatorsComponent').style.display = "none";
    }

    function backToMainModule(){
        document.getElementById('goToHome').style.display = "block";
        document.getElementById('attendaceModule').style.display = "none";
        document.getElementById('mainBdeComponents').style.display = "block";
        document.getElementById('goToMainModul').style.display = "none"; 
        document.getElementById('attendanceComponent').style.display = "block";
        document.getElementById('workLog').style.display = "block"; 
        document.getElementById('deleteEntry').style.display = "block";  
        document.getElementById('cooperatorsComponent').style.display = "block";
        
    }
</script>

<script>
    function deleteEntryConfirmation () {
      let text = "Izbriši ovaj zapis??.";
      if (confirm(text) == true) {
        document.getElementById('deleteThisEntry').submit();
      }
    }
</script>
@endsection