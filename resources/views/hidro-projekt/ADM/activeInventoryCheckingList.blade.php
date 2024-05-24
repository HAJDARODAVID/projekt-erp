@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Inventurna lista: {{ $activeInventory->inv_name }}<h1>            
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">
        @livewire('hidroProjekt.adm.inventory-checking-list-table',[
            'theme' => 'bootstrap-5',
            'invId' => $activeInventory->id
        ])
    </div>
@endsection
