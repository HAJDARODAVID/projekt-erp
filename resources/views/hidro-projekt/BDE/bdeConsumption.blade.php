@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <div class="modal-header">
                            <span class="modal-title">Materijal na gradilištu:</span>
                            <a class="btn btn-dark btn-sm" style="display:block" id="goToHome" href="{{ route('hp_workingDayEntry',$wd_id) }}">
                                <i class="bi bi-arrow-return-left"></i>
                            </a>
                        </div>
                    </div>   
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @livewire('hidroProjekt.bde.bde-consumption-table-component',[
                        'onStock' => $onStock,
                        'wdr' => $wd_id,
                    ])

                </div>
            </div>
        </div>
    </div>
</div>
<script>


</script>
@endsection