@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Dnevnik radova:</h1>
  </div>
  
  <div class="container">
    {{ $logs->links() }}
    <hr>
    @foreach ($logs as $log)
        <div class="alert alert-secondary" role="alert">
            <span class="alert-heading">
                <b>
                    {{ $log->getWorkingDayRecord->getUser->getWorker->fullName }}
                </b>
            </span><br>
            <span class="alert-heading">
                &nbsp;- {{ $log->getWorkingDayRecord->getConstructionSite->name }}
            </span><br>
            <span class="alert-heading">
                &nbsp;- {{ $log->created_at }}
            </span><br>
            <hr class="my-2">
            <p>{{ $log->log }}</p>
            <hr class="my-2">
            <button class="btn btn-success btn-sm">Više...</button>
        </div>
    @endforeach
  </div>
@endsection