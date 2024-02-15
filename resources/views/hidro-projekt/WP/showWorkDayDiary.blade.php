@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">#{{ $wdr->id }} - {{ $wdr->date }}: {{ $constSite->name }}</h1>
  </div>

  
  
  <div class="mx-5">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Osnovne informacije</a>
      </li>
      {{-- <li class="nav-item" role="presentation">
        <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Tab 2</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="simple-tab-2" data-bs-toggle="tab" href="#simple-tabpanel-2" role="tab" aria-controls="simple-tabpanel-2" aria-selected="false">Tab 3</a>
      </li> --}}
    </ul>
    <div class="tab-content pt-2" id="tab-content">
      <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
        <x-wp.daily-diary-wdr-info
          :groupLeader="$groupLeader"
          :constSite="$constSite"
          :car="$car"
          :carMileage="$carMileage"
          :stringLog="$stringLog"
          :attendance="$attendance"
          :attendanceCoOp="$attendanceCoOp"
        />
      </div>
      {{-- <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">Tab 2 selected</div>
      <div class="tab-pane" id="simple-tabpanel-2" role="tabpanel" aria-labelledby="simple-tab-2">Tab 3 selected</div> --}}
    </div>
  </div>
@endsection