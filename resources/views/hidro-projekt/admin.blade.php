@extends('layouts.mainAdminLayout')

@section('content')
HIDRO PROJEKT
{{-- @if (Auth::user()->id == 5)
<img src="{{ asset('images/happy.png') }}" class="rounded mx-auto d-block mt-2" alt="..." id="currentCarPic" style="height:250px; width:auto;max-width: 644px">   
@endif --}}


<div class="container">
    <div class="row">
        <div class="col col-sm">
            <div class="alert alert-danger" role="alert">
                <h6 class="alert-heading">ERROR!</h6>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </div>
        <div class="col">
            <div class="alert alert-success" role="alert">
                <h6 class="alert-heading">ERROR!</h6>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </div>
        <div class="col">
            <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading">ERROR!</h6>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="alert alert-danger" role="alert">
                <h6 class="alert-heading">ERROR!</h6>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </div>
        <div class="col">
            <div class="alert alert-success" role="alert">
                <h6 class="alert-heading">ERROR!</h6>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </div>
        <div class="col">
            <div class="alert alert-success" role="alert">
                <h6 class="alert-heading">ERROR!</h6>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </div>
    </div>
</div>


@endsection