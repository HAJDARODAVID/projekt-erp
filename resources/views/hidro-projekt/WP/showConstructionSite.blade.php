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
    
    
  </div>
  
  <div class="container">
    hello
  </div>
<script>
    function enableHeaderNameChange(){
        document.getElementById('constSiteHeaderName').style.display ="none";
        document.getElementById('constSiteHeaderNameChange').style.display ="block";
    }
</script>
@endsection