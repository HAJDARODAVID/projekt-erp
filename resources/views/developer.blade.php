@extends('layouts.developer')

@section('content')
    <div class="mt-3">
        <h3>DEVELOPER</h3><hr>
        @livewire('components.modal.calendar', key('calendar-modal'))
    </div>
@endsection