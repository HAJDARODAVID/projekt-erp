@extends('layouts.mainAdminLayout')

@section('content')
    <x-snowflakes :show=FALSE />

    <div class="container">

        <x-dashboard.layouts.layout-main />

    </div>
    {{-- @if (Auth::user()->id == 5)
    <img src="{{ asset('images/happy.png') }}" class="rounded mx-auto d-block mt-2" alt="..." id="currentCarPic" style="height:250px; width:auto;max-width: 644px">   
    @endif --}}
@endsection