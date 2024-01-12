@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Popis radnika:</h1>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <br>
    <a class="btn btn-success btn-sm" href="{{ route('hp_newWorkerForm') }}">NOVI RADNIK</a>
    <a class="btn btn-dark btn-sm" style = "width: 50px" href="javascript: w=window.open('{{ route('hp_payrollLabels') }}');">
      <i class="bi bi-printer"></i>
    </a>
    <hr>
    <livewire:hidroProjekt.hr.workers-table theme="bootstrap-5" />
    <button class="btn btn-success btn-sm" onclick="event.preventDefault(); document.getElementById('inputFieldFromFolder').click();">UČITAJ SLIKU</button>
    <button class="btn btn-success btn-sm" onclick="event.preventDefault(); document.getElementById('inputFieldFromCamera').click();">SLIKAJ SLIKU</button>
                    
      <input id="inputFieldFromFolder" type="file" accept="image/*" />
      <input id="inputFieldFromCamera" type="file" accept="image/*" capture="camera" />
  </div>
@endsection
