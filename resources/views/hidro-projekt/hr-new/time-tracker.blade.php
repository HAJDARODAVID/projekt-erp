@extends('layouts.mainAdminLayout')

@section('content')      
    {{-- @livewire('hidroProjekt.sales.register-component') --}}
    @livewire('domain.time-tracker.time-tracker')
    @livewire('domain.time-tracker.day-attendance-info-modal')
    @livewire('domain.time-tracker.worker-calendar-modal')
@endsection