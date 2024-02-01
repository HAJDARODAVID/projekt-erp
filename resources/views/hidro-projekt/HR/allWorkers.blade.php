@extends('layouts.mainAdminLayout')

@section('content')
{{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Kadar:</h1>
  </div> --}}

  <div class="mx-3 mt-3">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active"><b>Pregled zaposlenih</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link"><b>Popis radnika</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link bi bi-printer" href="javascript: w=window.open('{{ route('hp_payrollLabels') }}');"></a>
      </li>
    </ul>

    <div class="mx-5">
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
      @endif
      <br>

      <div class="">
        <a class="btn btn-success btn-sm" href="{{ route('hp_newWorkerForm') }}">NOVI RADNIK</a>
        <hr>
        <livewire:hidroProjekt.hr.workers-table theme="bootstrap-5" />
      </div>
      
    </div>
  </div>
@endsection
