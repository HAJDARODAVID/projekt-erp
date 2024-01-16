@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Evidencija radnog dana: ') }}{{ $record->date }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    


                    <h1 class="h6 d-flex align-items-center"><b>Radni sati na gradilištu</b></h1> 
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div> 
                    <hr>

                    @livewire('hidroprojekt.bde.bde-select-construction-site', [
                        'record' => $record,
                        ])
                    

                    @livewire('hidroprojekt.bde.bde-select-car',[
                        'selectedCar' => $record->car_id,
                        'record' => $record,
                        ])

                    @livewire('hidroprojekt.bde.bde-work-type-selector',[
                        'record' => $record,
                        ])
                    
                    <h1 class="h6"><b>Radnici na gradilištu</b></h1>
                    <div class="row">
                        <div class="col d-flex justify-content-center"><i class="bi bi-people-fill"></i>&nbsp : &nbsp<b>8</b></div>
                        <div class="col d-flex justify-content-center"> <button class="btn btn-success btn-sm">POPIS RADNIKA</button></div>
                    </div>
                    <hr>

                    <div class="col d-flex justify-content-center"> <button class="btn btn-dark "><i class="bi bi-book"></i> DNEVNIK RADOVA</button></div>




                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
@endsection