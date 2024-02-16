@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Parametri aplikacije:</h1>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">

        @if (Auth::user()->type == App\Models\User::USER_TYPE_SUPER_ADMIN)
            <a class="btn btn-success btn-sm" href="{{ route('hp_newWorkerForm') }}">NOVI PARAMETAR</a>
            <hr>
        @endif
        <div class="" style="@if(!$isPhone) padding-right: 350px @endif">
            @livewire('hidroProjekt.adm.app-params-table',[
            'theme' => 'bootstrap-5',
            ])
        </div>
        
    </div>
@endsection