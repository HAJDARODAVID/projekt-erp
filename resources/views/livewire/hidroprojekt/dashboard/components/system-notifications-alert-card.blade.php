<div class="alert alert-{{ $aType }} shadow pb-2" role="alert">
    <div class="alert-heading">
        <div class="d-flex justify-content-between">
            <div class="">
                <h6 class="m-0">{{ strtoupper($title) }}</h6>
                <div style="font-size: 11px;">26.10.2024 16:55</div>  
            </div>
            <div class="px-2 rounded" style="cursor: pointer">
                <b >x</b>
            </div>
        </div>
    <hr class="p-0 m-1 mb-2">
    </div>
    <p>{{ $message }}</p>
    <hr class="p-0 m-1 mb-2">
    <div class="d-flex justify-content-end">
        <button class="btn btn-sm">
            <div class="alert alert-{{ $aType }} shadow p-0 m-0 px-3 py-0">Više...</div>
        </button>
    </div>
</div>