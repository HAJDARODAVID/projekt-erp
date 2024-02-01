@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mx-5 ">{{ $carInfo->car_plates }} - {{ $carInfo->brand }} {{ $carInfo->model }}</h1>
    <div class="mx-5 ">
        <button id="editBtn" class="btn btn-success" onclick="editCars();">UREDI</button>
        <button id="saveBtn" class="btn btn-success" style="display: none" onclick="event.preventDefault(); document.getElementById('carForm').submit();">SPREMI</button>
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

    <form id="carForm" action="" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col">
                <h1 class="h6">Informacije o vozilu</h1>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="workPlace">Registracijske oznake</label>
                            <input type="text" class="form-control" id="workPlace" name="working_place"  disabled>
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
                            <input type="text" class="form-control" id="workPlace" name="working_place" disabled>
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
                            <input type="text" class="form-control" id="workPlace" name="working_place" disabled>
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
        </form>
            <div class="col">
                <div class="form-group">
                    <span class="btn btn-secondary btn-sm" id="carPicLabel" disabled>PROMJENI SLIKU</span>
                    <button class="btn btn-success btn-sm" id="saveCarPicture" onclick="saveCarAvatar()" style="display: none">POHRANI SLIKU!</button>
                    <a class="btn btn-dark btn-sm" style = "width: 50px" onclick="event.preventDefault();resetInputs(); document.getElementById('inputFieldFromFolder').click();">
                        <i class="bi bi-folder"></i>
                    </a>
                    {{-- <a class="btn btn-dark btn-sm" style = "width: 50px" onclick="event.preventDefault();resetInputs(); document.getElementById('inputFieldFromCamera').click();">
                        <i class="bi bi-camera"></i>
                    </a> --}}
                    <img src="@if (is_Null($carInfo->avatar)){{ asset('images/assets/cars/car_default.png') }} @else {{ asset('images/assets/cars/'.$carInfo->avatar) }} @endif" class="rounded mx-auto d-block mt-2" alt="..." id="currentCarPic" style="height:250px; width:auto;max-width: 444px">
                </div>
                


   
            </div>
        </div>
        

      <h1 class="h6">Troškovi vozila</h1>
    
  </div>
<form id="saveCarPicForm" action ="{{ route('hp_uploadCarAvatarImage') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <input name ="carAvatarCamera" id="inputFieldFromCamera" type="file" onchange="readURL(this)" capture="camera" class="invisible"/>
    <input name ="carAvatarFolder" id="inputFieldFromFolder" type="file" onchange="readURL(this)" class="invisible">
    <input type="hidden" name="plates" value="{{ $carInfo->car_plates }}">
    <input type="hidden" name="carId" value="{{ $carInfo->id }}">
</form>
  
<script>
    function resetInputs(){
        document.getElementById('inputFieldFromCamera').value = '';
        document.getElementById('inputFieldFromFolder').value = '';
    }
    function saveCarAvatar(){
        event.preventDefault();
        document.getElementById('saveCarPicForm').submit();
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
        
        var reader = new FileReader();
        reader.onload = function (e) { 
            document.getElementById('currentCarPic').setAttribute("src",e.target.result);
        };

        reader.readAsDataURL(input.files[0]); 
        }
        document.getElementById('saveCarPicture').style.display = 'inline';
        document.getElementById('carPicLabel').style.display = 'none';
  }
    function editCars(){
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