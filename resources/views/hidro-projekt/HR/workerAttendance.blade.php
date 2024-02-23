@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mx-5 ">{{ $worker->firstName }} {{ $worker->lastName }} - evidencija radnih sati</h1>
    <div class="mx-5 ">
        <a href = "{{ route('hp_allWorkHours') }}" class="btn btn-secondary">NATRAG</a>
    </div>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <x-hr.add-new-attendance-entry-modal
        :worker="$worker">
    </x-hr.add-new-attendance-entry-modal>

    <hr>

    @livewire('hidroProjekt.hr.worker-Attendance-table', [
        'theme' => "bootstrap-5",
        'worker_id' => $worker->id,
        ])

@endsection