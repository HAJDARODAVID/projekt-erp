@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Inventura materijala:</h1>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <x-admin-module-tabs name="main-inventory-tabs" :routeParams="[0]"></x-admin-module-tabs>
        </div>

        @if (!$activeInventory)
            @livewire('hidroProjekt.adm.start-new-inventory-check')
        @endif

        @if ($activeInventory)
            @livewire('hidroProjekt.adm.close-inventory-check',[
                'activeInventory' => $activeInventory,
            ])  
        @endif
        
        <hr>

        
    </div>
@endsection

{{-- Grandpa, stop molesting me... :'( - KvS S3E10 --}}