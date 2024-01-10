@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mx-5 ">{{ $worker->firstName }} {{ $worker->lastName }}</h1>
    <div class="mx-5 ">
        <button class="btn btn-success" onclick="editworker()">UREDI</button>
        <button class="btn btn-secondary">NATRAG</button>
    </div>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form id="workerForm">
        <h1 class="h6">Informacije o radniku</h1>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="workPlace">Radno mjesto</label>
                <input type="text" class="form-control" id="workPlace" name="working_place" value="{{ $worker->working_place }}" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="workPlace">OIB</label>
                <input type="text" class="form-control" id="workPlace" name="working_place" value="{{ $worker->OIB }}" disabled>
            </div>
        </div>
        <div class="row mb-2">
          <div class="form-group col-md-2">
            <label for="doe">Datum zapošljenja</label>
            <input type="date" class="form-control" id="doe" name="doe" value="{{ $worker->doe }}" disabled>
          </div>
          <div class="form-group col-md-2">
            <label for="inputPassword4">Istek ugovora</label>
            <input type="date" class="form-control" id="eoc"  name="eoc" value="{{ $worker->eoc }}" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="inputPassword4">Komentar</label> <br>
            <input type="text" class="form-control" id="workPlace" name="working_place" disabled>
          </div>
        </div>
        <div class="row mb-2">
            <div class="form-group col-md-1">
              <label for="doe">Zaposlen</label> <br>
              <input type="checkbox" disabled>
            </div>
            <div class="form-group col-md-1">
              <label for="inputPassword4">Radnik</label> <br>
              <input type="checkbox" disabled>
            </div>
          </div>


        

        <h1 class="h6" style="margin-top: 25px">Adresa stanovanja</h1>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="inputAddress">Ulica</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress">Mjesto</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="zip">Poštanski broj</label>
                <input type="text" class="form-control" id="zip" placeholder="42202" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress">Opčina</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Trnovec Bartolovecki" disabled>
            </div>
        </div>

        <h1 class="h6" style="margin-top: 25px">Kontakt</h1>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="inputAddress">Mobitel</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="098966258" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress">E-mail</label>
                <input type="email" class="form-control" id="inputAddress" placeholder="joedoe.hidroprojekt@gmail.com" disabled>
            </div>
        </div>
        
      </form>
    
  </div>

<script>
    function editworker(){
        var form = document.getElementById("workerForm");
        var elements = form.elements;
        for (var i = 0, len = elements.length; i < len; ++i) {
            elements[i].disabled = false;
        }
    }
</script>
@endsection