@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Popis radnih evidencija</div>
                <div class="card-body">
                    @livewire('hidroProjekt.bde.bde-my-entries-table', [
                        'user' => $user,
                        'theme' => "bootstrap-5",
                        ])
                </div>
            </div>
        </div>
    </div>
</div>
<script>


</script>
@endsection