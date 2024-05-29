@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Inventura: {{ $activeInventory->inv_name }}</h1>
        <div  class="d-flex">
            @livewire('hidroProjekt.adm.book-inventory-btn',[
                'activeInventory' => $activeInventory,
            ])
            @livewire('hidroProjekt.adm.add-items-to-inventory-modal', [
                'activeInventory' => $activeInventory,
            ])
            <a class="btn btn-primary btn-lg d-flex align-items-center mx-1" href="{{ route('hp_activeInventoryCheckingList', ['inv_name' => $activeInventory->inv_name])}}"><i class="bi bi-list-task"></i></a>
            <button class="btn btn-success btn-lg d-flex align-items-center mx-1" ><i class="bi bi-file-earmark-spreadsheet"></i></button>

            
            
        </div>
            
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">
        <p class="h5">Lista razlika</p>

        @livewire('hidroProjekt.adm.active-inventory-checking-diff',[
            'activeInventory' => $activeInventory,
        ])

        
    </div>
@endsection
