@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mx-5 ">{{ $worker->firstName }} {{ $worker->lastName }}</h1>
    <div class="mx-5 ">
        <button id="editBtn" class="btn btn-success" onclick="editworker();">UREDI</button>
        <button id="saveBtn" class="btn btn-success" style="display: none" onclick="event.preventDefault(); document.getElementById('workerForm').submit();">SPREMI</button>
        <a href="{{ route('hp_showWorker', $worker->id) }}" id="cancelBtn" class="btn btn-danger" style="display: none">OTKAŽI</a>
        <a href = "{{ route('hp_allWorkers') }}" class="btn btn-secondary">NATRAG</a>
    </div>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form id="workerForm" action="{{ route('hp_updateWorker', $worker->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h1 class="h6">Informacije o radniku</h1>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="workPlace">Radno mjesto</label>
                <input type="text" class="form-control" id="workPlace" name="working_place" value="{{ $worker->working_place }}" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="OIB">OIB</label>
                <input type="text" class="form-control" id="OIB" name="OIB" value="{{ $worker->OIB }}" disabled>
            </div>
        </div>
        <div class="row mb-2">
          <div class="form-group col-md-2">
            <label for="doe">Datum zapošljenja</label>
            <input type="date" class="form-control" id="doe" name="doe" value="{{ $worker->doe }}" disabled>
          </div>
          <div class="form-group col-md-2">
            <label for="ced">Istek ugovora</label>
            <input type="date" class="form-control" id="ced"  name="ced" value="{{ $worker->ced }}" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="comment">Komentar</label> <br>
            <input type="text" class="form-control" id="comment" name="comment" value="{{ $worker->comment }}" disabled>
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
                <label for="street">Ulica</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="1234 Main St" value="{{ $worker->getWorkerAddress->street }}" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="town">Mjesto</label>
                <input type="text" class="form-control" id="town" name="town" placeholder="1234 Main St" value="{{ $worker->getWorkerAddress->town }}" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="zip">Poštanski broj</label>
                <input type="text" class="form-control" id="zip"  name="zip" placeholder="42202" value="{{ $worker->getWorkerAddress->zip }}" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="county">Županija</label>
                <input type="text" class="form-control" id="county" name="county" placeholder="Trnovec Bartolovecki" value="{{ $worker->getWorkerAddress->county }}" disabled>
            </div>
        </div>

        <h1 class="h6" style="margin-top: 25px">Kontakt</h1>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="mob">Mobitel</label>
                <input type="text" class="form-control" id="mob" name="mob" placeholder="098966258" value="{{ $worker->getWorkerContact->mob }}" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="joedoe.hidroprojekt@gmail.com" value="{{ $worker->getWorkerContact->email }}" disabled>
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
        document.getElementById('editBtn').style.display = 'none';
        document.getElementById('cancelBtn').style.display = 'inline';
        document.getElementById('saveBtn').style.display = 'inline';
        

    }
</script>
@endsection