@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">#{{ $wdr->id }} - {{ $wdr->date }}: {{ $constSite->name }}</h1>
  </div>
  
  <div class="container">
    <div class="row">
      <div class="col">
        <p class="h6">Poslovođa:</p>
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="firstName">Ime</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $groupLeader->getWorker->firstName }}" disabled>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="lastName">Prezime</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $groupLeader->getWorker->lastName }}" disabled>
                </div> 
            </div>
        </div>

        <p class="h6">Gradilište:</p>
        <div class="row mb-3">
            <div class="form-group">
              <label for="name">Naziv gradilišta</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $constSite->name }}" disabled>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="town">Mjesto</label>
                    <input type="text" class="form-control" id="town" name="town" value="{{ $constSite->town }}" disabled>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="street">Ulica</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{ $constSite->street }}" disabled>
                </div> 
            </div>
        </div>

        <p class="h6">Vozilo:</p>
        <div class="row mb-1">
            <div class="col">
              <div class="form-group">
                <label for="car_plates">Registracijske oznake</label>
                <input type="text" class="form-control" id="car_plates" name="car_plates" value="{{ $car->car_plates }}" disabled>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                  <label for="brand">Marka</label>
                  <input type="text" class="form-control" id="brand" name="brand" value="{{ $car->brand }}" disabled>
              </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}" disabled>
                </div> 
            </div>
        </div>

        @if ($carMileage != NULL)
        <div class="row mb-3">
          <div class="col">
            <div class="form-group">
              <label for="star_mileage">Početno(km)</label>
              <input type="text" class="form-control" id="star_mileage" name="star_mileage" value="{{ $carMileage->start_mileage }}" disabled>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
                <label for="end_mileage">Završno(km)</label>
                <input type="text" class="form-control" id="end_mileage" name="end_mileage" value="{{ $carMileage->end_mileage }}" disabled>
            </div> 
          </div>
          <div class="col">
              <div class="form-group">
                  <label for="diff">Pređeno(km)</label>
                  <input type="text" class="form-control" id="diff" name="diff" value="{{ $carMileage->end_mileage - $carMileage->start_mileage }}" disabled>
              </div> 
          </div>  
        </div>
        @endif
        
        <p class="h6">Dnevnik radova:</p>
        <div class="row mb-3">
            <textarea class="form-control" id="job_description" rows="12" style="resize: none;" disabled>{{ $stringLog }}</textarea>
        </div>
      </div>

      <div class="col">
        
      </div>
    </div>


  </div>
@endsection