@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Evidencija radnih sati [Kooperati]:</h1>
  </div>
  
  <div class="mx-5">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    @livewire('hidroProjekt.hr.work-hours-co-op-report',[
        'selectedMonth' => date('m')*1,
        'selectedYear' => date('Y')*1,
    ])

    @livewire('hidroProjekt.hr.co-op-attendance-modal')


  </div>
@endsection