@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mx-3 border-bottom">
    <div class="d-flex flex-row ">
        <span class="h3" >#{{ $ticketInfo->id }} - {{ $ticketInfo->ticketName }}</span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @livewire('hidroProjekt.adm.change-ticket-status',[
            'status' => $ticketInfo->status,
            'ticket' => $ticketInfo->id,
        ])
    </div>
    <a href = "{{ route('hp_tickets') }}" class="btn btn-secondary">NATRAG</a>
  </div>

    <div class="container">
        <div class="row">
            <div class="col">
                @livewire('hidroProjekt.adm.change-ticket-description',[
                    'jobDescription' => $ticketInfo->job_description,
                    'ticket' => $ticketInfo->id,
                ])
            </div>
            <div class="col">
                <br>
                {{-- TU IDE NEKAJ DODATNOGA  --}}
            </div>
        </div>

    </div>

    

  </div>
<script>
    function enableHeaderNameChange(){
        document.getElementById('constSiteHeaderName').style.display ="none";
        document.getElementById('constSiteHeaderNameChange').style.display ="block";
    }
</script>
@endsection