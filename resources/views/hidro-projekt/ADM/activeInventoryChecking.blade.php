@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div>
            <h1 class="h3 pt-0 pb-0">Inventura: {{ $activeInventory->inv_name }}</h1><br>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">
        Lista razlika

        @livewire('hidroProjekt.adm.active-inventory-checking-diff',[
            'activeInventory' => $activeInventory,
        ])

        
    </div>
@endsection
