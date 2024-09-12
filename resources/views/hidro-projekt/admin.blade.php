@extends('layouts.mainAdminLayout')

@section('content')
    <x-snowflakes :show=FALSE />
    HIDRO PROJEKT
    {{-- @if (Auth::user()->id == 5)
    <img src="{{ asset('images/happy.png') }}" class="rounded mx-auto d-block mt-2" alt="..." id="currentCarPic" style="height:250px; width:auto;max-width: 644px">   
    @endif --}}
@endsection