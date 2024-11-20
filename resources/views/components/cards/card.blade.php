<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class=""><b>{{ strtoupper($title) }}</b></div>
            <div class="">{{ $headerBtn }}</div>
        </div>
      
    </div>
    <div class="card-body">
      {{ $slot }}
    </div>
</div>