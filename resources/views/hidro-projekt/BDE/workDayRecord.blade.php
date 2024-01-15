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

                    <h1 class="h6"><b>Gradilište</b></h1>
                    <select class="form-select form-select-sm mb-2" style="display:inline">
                        <option selected>Odaberi gradilište</option>
                        <option value="1">Mirogoj</option>
                        <option value="2">Njivice - kamp</option>
                        <option value="3">Minerva - bazen</option>
                    </select><br>

                    {{ __('Adresa: ') }} 
                    <a href="https://www.google.com/maps/place/Plitvička ulica 33 Šemovec">Plitvička ulica 33 Šemovec</a>
                    <hr>

                    <h1 class="h6"><b>Vozilo</b></h1>
                    {{ __('Registracija vozila: ') }} 
                    <select class="form-select form-select-sm" style="width: 150px;display:inline">
                        <option selected>Odaberi vozilo</option>
                        <option value="1">VŽ-999-HP</option>
                        <option value="2">VŽ-999-HP</option>
                        <option value="3">VŽ-999-HP</option>
                    </select>
                    <hr>

                    <h1 class="h6"><b>Vrsta terena</b></h1>
                        <div class="row">
                            <div class="col d-flex justify-content-center">Doma</div>
                            <div class="col d-flex justify-content-center">Teren</div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <input type="checkbox" name="vales" id="">
                            </div>
                            <div class="col d-flex justify-content-center">
                                <input type="checkbox" name="" id="">
                            </div>
                        </div>
                    <hr>
                    
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