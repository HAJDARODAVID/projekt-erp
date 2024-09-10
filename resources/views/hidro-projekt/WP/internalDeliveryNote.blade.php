@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Interna otpremnica</h1>
    </div>

    <div class="container">

        <div class="d-flex gap-3">
            @livewire('hidroProjekt.stg.book-to-const-site-modal')
            @livewire('hidroProjekt.wp.book-from-const-site-modal')
            <x-v-divider />
            @livewire('hidroProjekt.wp.book-to-construction-site-direct-modal')
        </div>
        

        <hr>

        @livewire('hidroProjekt.wp.internal-delivery-note-construction-sites-table',[
            'theme' => "bootstrap-5"
        ])

    </div>
@endsection