@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Evidencija radnih sati:</h1>
  </div>
  
  <div class="mx-5">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    @livewire('hidroProjekt.hr.work-hours-report',[
        'selectedMonth' => date('m')*1,
    ])

    @livewire('hidroProjekt.hr.worker-attendance-modal')

  </div>
@endsection