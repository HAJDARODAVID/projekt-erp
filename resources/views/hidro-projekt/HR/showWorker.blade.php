@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h3 mx-5 ">#{{ sprintf('%04d', $worker->id) }} - {{ $worker->fullName }}</h1>
        <h1 class="h6 mx-5 ">Status: {{ $worker->StatusDescriptionCro }}</h1>
    </div>
    <div class="mx-5 d-flex gap-1">
         @livewire('hidroProjekt.hr.disable-enable-worker-btn',['worker' => $worker])    
        <a href = "{{ url()->previous() }}" class="btn btn-secondary">NATRAG</a>
    </div>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @livewire('hidroProjekt.hr.basic-worker-info',[
        'workerModel' => $worker,
    ])  
    
    <div class="mt-3">
        @livewire('hidroProjekt.hr.worker-tabs',[
            'workerModel' => $worker,
            'userRoles' => $userRoles
        ])
    </div>
    
  </div>

<script>
    function editworker(){
        var form = document.getElementById("workerForm");
        var elements = form.elements;
        for (var i = 0, len = elements.length; i < len; ++i) {
            elements[i].disabled = false;
        }
        document.getElementById('editBtn').style.display = 'none';
        document.getElementById('cancelBtn').style.display = 'inline';
        document.getElementById('saveBtn').style.display = 'inline';
        

    }
</script>
@endsection