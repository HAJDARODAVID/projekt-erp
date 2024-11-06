@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
        <h1 class="h3">Interna narudžbenica</h1>
    </div>

    <div class="container">
        @livewire('hidroProjekt.Wp.int-orders-table',[
            'theme' => 'bootstrap-5',
        ])
    </div>
@endsection