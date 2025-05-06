@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Stanje skladišta:</h1>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="d-flex justify-content-between">
      @livewire('hidroProjekt.stg.book-to-storage-modal')  
      @livewire('domain.storage.storage-excel-export', ['type' => 'CONS'])  
    </div>
  
  <hr> 

    @livewire('hidroProjekt.stg.storage-stock-items-table',[
        'theme' => 'bootstrap-5',
    ])

  </div>
@endsection
