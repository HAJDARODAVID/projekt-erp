@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="d-flex flex-row">
        @livewire('hidroProjekt.wp.change-header-name-input-box',[
        'headerName' => $constructionSite->name,
        'headerId' => $constructionSite->id,
        ])
        &nbsp;&nbsp;&nbsp;
        @livewire('hidroProjekt.wp.change-construction-site-status',[
            'status' => $constructionSite->status,
            'constId' => $constructionSite->id,
        ])
    </div>
    <a href = "{{ route('hp_constructionSites') }}" class="btn btn-secondary">NATRAG</a>
  </div>
  
  <div class="container">
    <div class="row">
        <div class="col">
            <h1 class="h6">Informacije gradilišta:</h1>

            @livewire('hidroProjekt.wp.construction-site-address',[
                'town' =>$constructionSite->town,
                'street' =>$constructionSite->street,
                'constId' => $constructionSite->id,
            ])
            
            @livewire('hidroProjekt.wp.construction-site-from-to-dates', [
                'start_date' =>$constructionSite->start_date,
                'end_date' =>$constructionSite->end_date,
                'constId' => $constructionSite->id,
            ])
        </div>
        <div class="col">
            @livewire('hidroProjekt.wp.construction-site-job-description-textarea',[
                'description' => $constructionSite->job_description,
                'constId' => $constructionSite->id,
            ])
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <h1 class="h6">Evidencija radova:</h1>

            <b style="font-size: 15px"> Kumulativno izvršeni radni sati: {{$cumulativelyHours}}</b>   
    
        </div>
        <div class="col">
            <h1 class="h6">Dnevnik radova:</h1>
            <textarea class="form-control" id="job_description" rows="18" style="resize: none;" disabled>{{$allLogsForConstructionSite}}</textarea>
        </div>
    </div>
    

  </div>
<script>
    function enableHeaderNameChange(){
        document.getElementById('constSiteHeaderName').style.display ="none";
        document.getElementById('constSiteHeaderNameChange').style.display ="block";
    }
</script>
@endsection