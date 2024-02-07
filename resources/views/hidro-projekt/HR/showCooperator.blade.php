@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mx-5 ">{{ $cooperator->name }}</h1>
    <div class="mx-5 ">
        <a href = "{{ route('hp_cooperators') }}" class="btn btn-secondary">NATRAG</a>
    </div>
  </div>
  
<div class="container">
  @if ($message = Session::get('success'))
    <div class="alert alert-success" id="alert">
      <p>{{ $message }}</p>
    </div>
    <script>fadeAway('alert');</script>
  @endif

  <x-hr.add-new-cooperator-worker :cooperatorId="$cooperator->id"></x-hr.add-new-cooperator-worker>
  <hr>

  <div style="padding-right: 600px">

    @livewire('hidroProjekt.hr.cooperator-workers-table', [
      'theme' => "bootstrap-5",
      'cooperatorId' => $cooperator->id,
    ])

  </div>

  

</div>

<script>
</script>
@endsection