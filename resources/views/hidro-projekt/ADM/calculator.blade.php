@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Kalkulator:</h1>
    </div>
  
    <div class="container">
        <div class="row mb-2">
            <div class="col"><b>PDV kalkulator</b></div>
            <div class="col"><b>Kalkulator postotka</b></div>
        </div>
        <div class="row">
            <div class="col">
                @livewire('pdv-calculator',[
                    'type' => 'add',
                ], key('add'))

                @livewire('pdv-calculator',[
                    'type' => 'remove',
                ], key('remove'))
            </div>
            <div class="col">
                @livewire('percentage-calculator',[
                    'type' => 'add',
                ], key('add'))

                @livewire('percentage-calculator',[
                    'type' => 'remove',
                ], key('remove'))
            </div>
        </div>
        <hr>
        <b>NOVI KALKULATOR</b>
        <br><br>
        @livewire('percentage-calculator',[
            'newStyle' => TRUE,
        ], key('remove'))
        
    </div>
@endsection