@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mx-5 ">Unos novog radnika</h1>
    <div class="mx-5 ">
        <button class="btn btn-success" onclick="event.preventDefault(); document.getElementById('newWorkerForm').submit();">SPREMI</button>
        <button class="btn btn-secondary">NATRAG</button>
    </div>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form id="newWorkerForm" method="POST" action="{{ route('hp_addNewWorker') }}">
        @csrf
        @method('POST')
        <h1 class="h6">Informacije o radniku</h1>
        <div class="row mb-2">
            <div class="form-group col-md-4">
              <label for="firstName">Ime</label>
              <input type="text" class="form-control" id="firstName" name="firstName" >
            </div>
            <div class="form-group col-md-4">
              <label for="lastName">Prezime</label>
              <input type="text" class="form-control" id="lastName"  name="lastName" >
            </div>
          </div>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="workPlace">Radno mjesto</label>
                <input type="text" class="form-control" id="workPlace" name="working_place">
            </div>
            <div class="form-group col-md-4">
                <label for="OIB">OIB</label>
                <input type="text" class="form-control" id="OIB" name="OIB" >
            </div>
        </div>
        <div class="row mb-2">
          <div class="form-group col-md-2">
            <label for="doe">Datum zapošljenja</label>
            <input type="date" class="form-control" id="doe" name="doe" value="{{ $todayDate }}">
          </div>
          <div class="form-group col-md-2">
            <label for="ced">Istek ugovora</label>
            <input type="date" class="form-control" id="ced"  name="ced" >
          </div>
          <div class="form-group col-md-4">
            <label for="comment">Komentar</label> <br>
            <input type="text" class="form-control" id="comment" name="comment" >
          </div>
        </div>
        <div class="row mb-2">
            <div class="form-group col-md-1">
              <label for="inputPassword4">Radnik</label> <br>
              <input type="checkbox" >
            </div>
          </div>


        

        <h1 class="h6" style="margin-top: 25px">Adresa stanovanja</h1>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="street">Ulica</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="1234 Main St" >
            </div>
            <div class="form-group col-md-4">
                <label for="town">Mjesto</label>
                <input type="text" class="form-control" id="town" name="town" placeholder="1234 Main St" >
            </div>
        </div>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="zip">Poštanski broj</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="42202" >
            </div>
            <div class="form-group col-md-4">
                <label for="county">Županija</label>
                <input type="text" class="form-control" id="county" name="county" placeholder="Varaždinska" >
            </div>
        </div>

        <h1 class="h6" style="margin-top: 25px">Kontakt</h1>
        <div class="row mb-2">
            <div class="form-group col-md-4">
                <label for="mob">Mobitel</label>
                <input type="text" class="form-control" id="mob" name="mob" placeholder="098966258" >
            </div>
            <div class="form-group col-md-4">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="joedoe.hidroprojekt@gmail.com" >
            </div>
        </div>        
      </form>
    
  </div>
@endsection