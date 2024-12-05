<div>
    <div class="d-flex justify-content-center p-1" onclick="location.href='{{ route('showBdeWorkReport', $entry->id) }}';" style="cursor: pointer;">   
        <div class="panel-body shadow" style="width: 230px;border-radius: 5px; {{ $cardStyle }}">
            <div class="py-1 px-2">
                <b class="d-inline-block text-truncate" style="max-width: 215px;">{{$entry->getConstructionSite->name}}</b><br>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <i class="bi bi-people-fill"></i> : {{ $workerCount }}
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