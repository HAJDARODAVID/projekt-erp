@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Inventure materijala:</h1>
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
            <button class="btn btn-success">POKRENI INVENTURU</button>    
        @endif

        @if ($activeInventory)
            <button class="btn btn-danger">ZATVORI INVENTURE: {{ $activeInventory->inv_name }}</button>   
        @endif
        
        <hr>
        
        {{ round(microtime(true) * 1000) }} <br>
        {{ date("Y-m-d") }}-{{ substr(round(microtime(true) * 1000),9); }}
        
    </div>
@endsection

{{-- Grandpa, stop molesting me... :'( - KvS S3E10 --}}