@extends('layouts.mainAdminLayout')

@section('content')

    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <x-adm.master-data-tabs></x-adm.master-data-tabs>
    </div>

    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" id="alert">
                <p>{{ $message }}</p>
            </div>
            <script>fadeAway('alert');</script>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger" id="alert">
                <p>{{ $message }}</p>
            </div>
            <script>fadeAway('alert');</script>
        @endif
    </div>

    <div class="container">
        @livewire('hidroProjekt.adm.create-new-supplier')
        <hr>
        @livewire('hidroProjekt.adm.suppliers-table', [
        'theme' => "bootstrap-5",
        ])
    </div>
@endsection