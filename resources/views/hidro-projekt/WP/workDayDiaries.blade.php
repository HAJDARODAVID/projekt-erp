@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Radni dnevnik:</h1>
  </div>
  
  <div class="container">
    ja sam radni dnevnik yo
    <livewire:hidroProjekt.wp.work-diary-table theme="bootstrap-5" />



  </div>
@endsection