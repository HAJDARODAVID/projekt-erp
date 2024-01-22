<div>
    <div class="d-flex justify-content-center mb-2" id="test2" onclick="location.href='{{ route('hp_workingDayEntry', $entry->id) }}';" style="cursor: pointer;">   
        <div clas="panel-body" style="height: 65px; width: 230px;border-radius: 5px; ">@isset($isEntryComplete['cardStyle']) {{$isEntryComplete['cardStyle']}} @endisset
            <div class="p-2">
                <b class="d-inline-block text-truncate" style="max-width: 215px;">{{$entry->getConstructionSite->name}}</b><br>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <i class="bi bi-people-fill"></i> : {{ $worker_count }}
                    </div>
                    <div class="col d-flex justify-content-center">
                        {{-- <i class="bi bi-clock"></i> : 10 --}}
                    </div>
                    <div class="col d-flex justify-content-center">             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>