@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <div class="modal-header">
                            <span class="modal-title"><b>NOVA NARUDŽBENICA:</b></span>
                            <a class="btn btn-dark btn-sm" style="display:block" id="goToHome" href="{{ route('home') }}">
                                <i class="bi bi-arrow-return-left"></i>
                            </a>
                        </div>
                    </div>   
                </div>
                <div class="card-body">
                    @livewire('hidroProjekt.bde.bde-internal-order-form')    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection