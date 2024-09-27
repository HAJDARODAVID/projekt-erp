@extends('layouts.mainAdminLayout')

@section('content')
    <x-snowflakes :show=FALSE />

    <div class="container">

        <div class="vh-100 ">

                <div class="row h-25">
                    <div class="col mx-2 rounded" style="background-color: rgb(209, 209, 209)">
                        <div class="my-4 px-3">
                            <div class="h5">Stanje materijala</div>
                            <table class="mx-2">
                                <tbody>
                                    <tr>
                                        <td>Skladište:</td>
                                        <td>12.0548,35€</td>
                                    </tr>
                                    <tr>
                                        <td>Gradilište:</td>
                                        <td>514.258,68€</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <div class="col mx-2 rounded" style="background-color: rgb(209, 209, 209)"></div>
                    <div class="col mx-2 rounded" style="background-color: rgb(209, 209, 209)"></div>
                </div>
                <div class="row h-50 mt-3">
                    <div class="col mx-2 rounded" style="background-color: rgb(209, 209, 209)"></div>
                    <div class="col mx-2 rounded" style="background-color: rgb(209, 209, 209)"></div>
                </div>
        </div>

    </div>
    {{-- @if (Auth::user()->id == 5)
    <img src="{{ asset('images/happy.png') }}" class="rounded mx-auto d-block mt-2" alt="..." id="currentCarPic" style="height:250px; width:auto;max-width: 644px">   
    @endif --}}
@endsection