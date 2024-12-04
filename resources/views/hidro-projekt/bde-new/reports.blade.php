@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Popis radnih evidencija</div>
                <div class="card-body">
                    @livewire('domain.bde.my-reports-table', [
                        'user' => $user->id,
                        'theme' => "bootstrap-5",
                        ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection