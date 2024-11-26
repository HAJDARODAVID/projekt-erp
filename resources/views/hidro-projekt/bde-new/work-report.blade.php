@extends('layouts.app')

@section('content')
@if ($clear)
    <script>localStorage.clear();</script>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @livewire('domain.bde.main-work-report-form',[
                'dailyWorkReport' => $dailyWorkReport,
            ])       
        </div>
    </div>
</div>
@endsection