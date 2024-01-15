@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Evidencija rada: ') }}{{ date("d.m.Y") }}</div>
                {{dd($myRecords)}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <x-bde.working-day-entry-card></x-bde.working-day-entry-card>
                    <div class="d-flex justify-content-center mb-2" id="test2" onclick="location.href='{{ route('hp_bdeHome') }}';" style="cursor: pointer;">   
                        <div clas="panel-body" style="height: 65px; width: 230px;border-radius: 5px;background: rgb(0,208,3);
                        background: linear-gradient(121deg, rgba(0,208,3,1) 0%, rgba(18,171,23,1) 100%);">
                            <div class="p-2">
                                <b>Visoko veleučilište u Zagrebu</b><br>
                                
                                <div class="row">
                                    <div class="col d-flex justify-content-center">
                                        <i class="bi bi-people-fill"></i> : 8
                                    </div>
                                    <div class="col d-flex justify-content-center">
                                        <i class="bi bi-clock"></i> : 10
                                    </div>
                                    <div class="col d-flex justify-content-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb-2">   
                        <div clas="panel-body" style="height: 65px; width: 230px;border-radius: 5px;background: rgb(195,77,34);
                        background: linear-gradient(333deg, rgba(195,77,34,1) 0%, rgba(253,153,45,1) 100%);">
                            <div class="p-2">
                                <b>Visoko veleučilište u Zagrebu</b><br>
                                
                                <div class="row">
                                    <div class="col d-flex justify-content-center">
                                        <i class="bi bi-people-fill"></i> : 8
                                    </div>
                                    <div class="col d-flex justify-content-center">
                                        <i class="bi bi-clock"></i> : 10
                                    </div>
                                    <div class="col d-flex justify-content-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb-2">   
                        <button class="btn btn-success" style="height: 65px; width: 230px" onclick="location.href='{{ route('hp_newWorkingDayEntry') }}'"><b>+ DODAJ NOVI ZAPIS</b></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>


</script>
@endsection