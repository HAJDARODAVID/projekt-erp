@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Pregled računa</h1>
        <div  class="d-flex gap-2">
            @livewire('hidroProjekt.costs.add-new-bill-modal-component')
            <x-v-divider></x-v-divider>
            @livewire('hidroProjekt.costs.add-new-provider-modal')
            @livewire('hidroProjekt.costs.add-new-category-modal')
            
        </div>
            
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">
    </div>
@endsection
