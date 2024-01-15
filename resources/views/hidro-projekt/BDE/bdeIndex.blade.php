@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Evidencija rada: ') }}{{ date("d.m.Y") }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-center mb-2" id="test2" onclick="location.href='{{ route('hp_bdeHome') }}';" style="cursor: pointer;">   
                        <div clas="panel-body" style="height: 65px; width: 230px;border-radius: 5px;background: rgb(34,195,39);
                        background: linear-gradient(333deg, rgba(34,195,39,1) 0%, rgba(45,253,48,1) 100%);">
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
                        <button class="btn btn-success" style="height: 65px; width: 230px"><b>+ DODAJ NOVI ZAPIS</b></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>


</script>
@endsection