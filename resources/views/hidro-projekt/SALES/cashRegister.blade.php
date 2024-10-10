@extends('layouts.mainAdminLayout')

@section('content')    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    @livewire('hidroProjekt.sales.register-component')
@endsection