@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Popis gradilišta:</h1>
  </div>
  
  <div class="container">
    <x-wp.add-new-construction-site></x-wp.add-new-construction-site>
    <hr>
    <livewire:hidroProjekt.wp.construction-sites-table theme="bootstrap-5" />



  </div>
@endsection