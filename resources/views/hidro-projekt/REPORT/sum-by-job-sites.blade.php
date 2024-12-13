@extends('layouts.mainAdminLayout')

@section('content')
<div class="">
  <div class="rounded shadow border p-3">
      <div class="d-flex align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:45px">
          <div class="h5 px-4"><b>IZVJEŠTAJ GRADILIŠTA</b></div>
      </div>
      <div class="row">
        @livewire('domain.tables.report.sum-info-by-job-site')          
      </div>
  </div>
</div>
@endsection