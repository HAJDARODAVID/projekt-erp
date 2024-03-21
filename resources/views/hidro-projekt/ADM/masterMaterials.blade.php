@extends('layouts.mainAdminLayout')

@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">MATERIJALI</h1>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">
        <button class="btn btn-success d-flex align-items-center" onclick="window.location.href='{{ route('hp_createNewMaterialForm') }}';">
            <i class="bi bi-plus-circle"></i>&nbsp;NOVI MATERIAL
        </button>
        <hr>
        @livewire('hidroprojekt.adm.material-master-data-table',[
            'theme' => "bootstrap-5"
        ])
    </div>
@endsection