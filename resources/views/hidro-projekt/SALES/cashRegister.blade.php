@extends('layouts.mainAdminLayout')

@section('content')    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">
        <div class="d-flex mx-3">
            <div class="h5"><b>INTERNA BLAGAJNA</b></div>
        </div>
        <div class="row">
            <div class="col-sm-4 p-3">
                <div class="alert alert-light m-0 mb-4 shadow">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Kupca</label>
                        <input type="text" class="form-control">
                    </div>
                    <hr class="m-0 my-2">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Način plačanja</label>
                        <input type="text" class="form-control" placeholder="Kupac">
                    </div>
                    <div class="form-group mb-3 mx-2">
                        <label for="">Status plačanja</label>
                        <input type="text" class="form-control" placeholder="Kupac">
                    </div>
                </div>
                <div class="alert alert-light m-0 shadow">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Ukupni iznos</label>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <hr class="m-0 my-2">
                    <div class="form-group mb-3 mx-2">
                        <label for="">Način plačanja</label>
                        <input type="text" class="form-control" placeholder="Kupac">
                    </div>
                    <div class="form-group mb-3 mx-2">
                        <label for="">Status plačanja</label>
                        <input type="text" class="form-control" placeholder="Kupac">
                    </div>
                </div>
            </div>
            <div class="col-sm p-3">
                <div class="alert alert-light shadow m-0" style="height: 600px">
                    <div class="d-flex mb-2">
                        <div class="form-group mb-2 mx-2" style="width: 250px" >
                            <input type="number" class="form-control" placeholder="Br. materijala">
                        </div>
                        <button class="btn btn-success align-items-center" style="height: 38px"><i class="bi bi-plus-circle"></i></button>
                    </div>
                    <hr class="m-0 my-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#Materijal</th>
                                <th>Naziv proizvoda</th>
                                <th>Kol.</th>
                                <th>Cijena</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>500073</td>
                                <td>Dracolastic 150 A(15KG)+B(5KG) 20KG (polimercement)</td>
                                <td><input type="number" class="form-control" style="width: 70px"></td>
                                <td><input type="number" class="form-control" style="width: 100px"></td>
                                <td><button class="btn btn-danger btn-sm align-items-center"><i class="bi bi-x-circle"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection