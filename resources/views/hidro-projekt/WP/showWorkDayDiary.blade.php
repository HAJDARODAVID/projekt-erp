@extends('layouts.mainAdminLayout')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    {{-- <h1 class="h3">#{{ $wdr->id }} - {{ $wdr->date }}: {{ $constSite->name }}</h1> --}}
  </div>
  <div class="mx-3">
    <x-wp.daily-diary-wdr-info-form
      :wdr="$wdr"
      :groupLeader="$groupLeader"
      :constSite="$constSite"
      :car="$car"
      :carMileage="$carMileage"
      :stringLog="$stringLog"
      :attendance="$attendance"
      :attendanceCoOp="$attendanceCoOp"
      :arst="$arst"
      :isPhone="$isPhone"
    />
  </div>
@endsection