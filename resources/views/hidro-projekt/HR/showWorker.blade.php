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
        
        <div class="form-group">
          <label for="inputAddress2">Address 2</label>
          <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="inputCity">
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">State</label>
            <select id="inputState" class="form-control">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" id="inputZip">
          </div>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              Check me out
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
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