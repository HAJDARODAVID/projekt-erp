@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Popis voznog parka:</h1>
  </div>
  
  <div class="container">
    
        <x-assets.add-new-car-btn></x-assets.add-new-car-btn>
        <hr>
        <livewire:hidroProjekt.assets.company-cars-table theme="bootstrap-5" />

  </div>
@endsection