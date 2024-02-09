@extends('layouts.mainAdminLayout')

@section('content')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Tickets:</h1>
</div>
  
<div class="container">
    <x-adm.create-new-ticket></x-adm.create-new-ticket>
</div>
@endsection