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
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <x-admin-module-tabs name="construction-site-info" :routeParams="[4]"></x-admin-module-tabs>
    </div>
    
    {{-- {{ dd($stock) }} --}}
    @livewire('hidroProjekt.wp.construction-site-stock-table',[
        'theme' => "bootstrap-5"
    ])
    

  </div>
<script>
    function enableHeaderNameChange(){
        document.getElementById('constSiteHeaderName').style.display ="none";
        document.getElementById('constSiteHeaderNameChange').style.display ="block";
    }
</script>
@endsection