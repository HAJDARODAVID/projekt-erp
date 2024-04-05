@extends('layouts.mainAdminLayout')

@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="h3" style="padding-left: 50px">{{ $mmInfo->id }} - {{ $mmInfo->name }}</h1>
        <a href = "{{ route('hp_masterMaterial') }}" class="btn btn-secondary" style="margin-right: 50px">NATRAG</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container d-flex justify-content-center">
        <div class="" style="width: 750px">
            @livewire('hidroProjekt.adm.material-component', [
                'uom' => $uom,
                'type' => 'show',
                'mmModal' => $mmInfo,
                'suppliers' => $suppliers,
            ])
        </div>
    </div>
@endsection