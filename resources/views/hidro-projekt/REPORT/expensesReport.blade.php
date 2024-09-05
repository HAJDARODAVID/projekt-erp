@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Izvještaj troškova</h1>
  </div>
  
  <div class="container">
    @livewire('hidroProjekt.report.expenses-report')
  </div>
@endsection