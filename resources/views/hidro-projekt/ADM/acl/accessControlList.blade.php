@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Access control list</h1>  
        @hasRights(create-resources-or-roles)
            <div>
                @livewire('hidroProjekt.adm.acl.add-new-role-or-resource')
            </div>
        @endHasRights    
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert">
            <p>{{ $message }}</p>
        </div>
        <script>fadeAway('alert');</script>
    @endif
  
    <div class="container">
        @livewire('hidroProjekt.adm.acl.groups-and-resources')
    </div>
@endsection
