@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mx-5 ">{{ $carInfo->car_plates }} - {{ $carInfo->brand }} {{ $carInfo->model }}</h1>
    <div class="mx-5 ">
        <button id="editBtn" class="btn btn-success" onclick="editworker();">UREDI</button>
        <button id="saveBtn" class="btn btn-success" style="display: none" onclick="event.preventDefault(); document.getElementById('workerForm').submit();">SPREMI</button>
        <a href="" id="cancelBtn" class="btn btn-danger" style="display: none">OTKAŽI</a>
        <a href = "{{ route('hp_allWorkers') }}" class="btn btn-secondary">NATRAG</a>
    </div>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form id="workerForm" action="" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col">
                <h1 class="h6">Informacije o vozilu</h1>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="workPlace">Registracijske oznake</label>
                            <input type="text" class="form-control" id="workPlace" name="working_place" value="MERCEDENZ FRAŽJI BENZ YO" disabled>
                        </div> 
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="workPlace">Registriran do:</label>
                            <input type="date" class="form-control" id="workPlace" name="working_place" value="" disabled>
                        </div> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="workPlace">Marka</label>
                            <input type="text" class="form-control" id="workPlace" name="working_place" value="MERCEDENZ FRAŽJI BENZ YO" disabled>
                        </div> 
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="workPlace">Model</label>
                            <input type="text" class="form-control" id="workPlace" name="working_place" value="" disabled>
                        </div> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="workPlace">Godište</label>
                            <input type="text" class="form-control" id="workPlace" name="working_place" value="MERCEDENZ FRAŽJI BENZ YO" disabled>
                        </div> 
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="workPlace">Nabavna cijena</label>
                            <input type="text" class="form-control" id="workPlace" name="working_place" value="" disabled>
                        </div> 
                    </div>
                </div>
                
            </div>
            <div class="col">
                <div class="form-group">
                    <button class="btn btn-success btn-sm" onclick="event.preventDefault(); document.getElementById('inputFieldFromFolder').click();">UČITAJ SLIKU</button>
                    <img src="{{ asset('images/assets/cars/car_default.png') }}" class="rounded mx-auto d-block" alt="...">
                </div> 
                
            </div>
        </div>
        
      </form>

      <input id="inputFieldFromFolder" type="file" accept="image/*" capture="camera" />

      <h1 class="h6">Troškovi vozila</h1>
    
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