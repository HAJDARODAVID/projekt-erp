@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Evidencija rada: ') }}{{ date("d.m.Y") }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($myRecords as $entry)
                        <x-bde.working-day-entry-card :entry="$entry"></x-bde.working-day-entry-card>
                    @endforeach
                    <div class="d-flex justify-content-center mb-2">   
                        <button class="btn btn-danger" style="height: 65px; width: 230px" onclick="location.href='{{ route('hp_newWorkingDayEntry') }}'"><b>+ DODAJ NOVI ZAPIS</b></button><br>
                        <button class="btn btn-success" style="height: 65px; width: 230px" onclick="location.href='{{ route('createNewReport') }}'"><b>+ DODAJ NOVI ZAPIS - NEW</b></button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center mb-2">   
                        <button class="btn btn-primary" style="height: 55px; width: 230px" 
                            onclick="location.href='{{ route('hp_bdeOrderForm') }}'">
                            <i class="bi bi-file-earmark-text"></i>
                            <b>NARUDŽBENICA</b>
                        </button>
                    </div>
                    <hr>
                    @if ($activeInv)
                        <div class="d-flex justify-content-center mb-2">   
                            <button class="btn btn-dark" style="height: 55px; width: 230px" 
                                onclick="location.href='{{ route('hp_bdeInventoryModule') }}'">
                                <i class="bi bi-list-check"></i>
                                <b>INVENTURA</b>
                            </button>
                        </div>
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</div>
<script>


</script>
@endsection