@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mx-5 ">Obračun plaće po radniku:</h1>
    {{-- <div class="mx-5 ">     
        <a href = "{{ url()->previous() }}" class="btn btn-secondary">NATRAG</a>
    </div> --}}
</div>
  
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @livewire('hidroProjekt.hr.payroll-accounting-component')
    
</div>

@endsection