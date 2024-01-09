@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Evidencija radnog dana: 09.01.2024') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Poslovođa: Tomislav Šoštarek') }} <br> <br>

                    {{ __('Gradilište: ') }} <select class="form-select form-select-sm" style="width: 220px;display:inline">
                        <option selected>Katedrala zagreb</option>
                        <option value="1">Mirogoj</option>
                        <option value="2">Njivice - kamp</option>
                        <option value="3">Minerva - bazen</option>
                      </select> <br>

                    {{ __('Adresa: ') }} 
                    <a href="https://www.google.com/maps/place/Plitvička ulica 33 Šemovec">Plitvička ulica 33 Šemovec</a><br> <br>

                    {{ __('Registracija vozila: ') }} <select class="form-select form-select-sm" style="width: 120px;display:inline">
                        <option selected>VŽ-999-HP</option>
                        <option value="1">VŽ-999-HP</option>
                        <option value="2">VŽ-999-HP</option>
                        <option value="3">VŽ-999-HP</option>
                      </select><br>

                      {{ __('Početni kilometri - Završni kilometri') }} <br>
                      <input type="text"style="width: 110px"> - <input type="text" style="width: 110px;display:inline"><br><br>

                      {{ __('Terenski rad: ') }} <input type="checkbox" name="" id=""><br> 
                      {{ __('Radni sati na gradilištu: ') }} <input type="text" name="" id="" placeholder="8" style="width: 80px;display:inline">

                      {{ __('Popis radnika: ') }} <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01" max="2018-12-31" />
                      <table>
                        <tr>
                            <td>Ime prezime</td>
                            <td>Radni sati</td>
                        </tr>
                        <tr>
                            <td>David Hajdarovic</td>
                            <td>8</td>
                        </tr>
                        <tr>
                            <td>Lucija Sostarek</td>
                            <td>8</td>
                        </tr>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
@endsection