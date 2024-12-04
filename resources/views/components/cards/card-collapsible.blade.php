<div class="card" x-data="{ open: false }">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class=""><b>{{ strtoupper($title) }}</b></div>
            <div class="">
                <button class="btn btn-dark btn-sm align-content-center" style="height: 28px" x-on:click="open = ! open"><i class="bi bi-dash-square"></i></button>
            </div>
        </div>
      
    </div>
    <div class="card-body" x-show="open">
      {{ $slot }}
    </div>
</div>