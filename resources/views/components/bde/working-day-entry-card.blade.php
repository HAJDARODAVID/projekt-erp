<div>
    <div class="d-flex justify-content-center mb-2" id="test2" onclick="location.href='{{ route('hp_bdeHome') }}';" style="cursor: pointer;">   
        <div clas="panel-body" style="height: 65px; width: 230px;border-radius: 5px;background: rgb(0,208,3);
        background: linear-gradient(121deg, rgba(0,208,3,1) 0%, rgba(18,171,23,1) 100%);">
            <div class="p-2">
                <b class="d-inline-block text-truncate" style="max-width: 215px;">{{$entry->getConstructionSite->name}}</b><br>
                
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
</div>