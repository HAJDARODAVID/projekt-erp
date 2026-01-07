@extends('layouts.mainAdminLayout')

@section('content')
    <x-snowflakes :show=FALSE />

    <div class="">
        @if (Auth::user()->id == 1)
            TESTING
        @endif
        @if (app('user_rights')->hasRight('dashboard'))
            @livewire('hidroProjekt.dashboard.main-layout')
        @endif
    </div>
    {{-- @if (Auth::user()->id == 5)
    <img src="{{ asset('images/happy.png') }}" class="rounded mx-auto d-block mt-2" alt="..." id="currentCarPic" style="height:250px; width:auto;max-width: 644px">   
    @endif --}}
@endsection