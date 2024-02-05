@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Popis kooperanta:</h1>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @livewire('hidroProjekt.hr.add-new-cooperator')
    <hr>

    @livewire('hidroProjekt.hr.cooperator-table', [
      'theme' => "bootstrap-5",
    ])

    

  </div>
@endsection
