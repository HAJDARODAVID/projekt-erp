<div class="card flex-grow-1 d-flex flex-column w-100">
  @if($title || $header) 
    <div class="card-header d-flex justify-content-between align-items-center">
      <div id="left">
        <div class="d-flex align-items-center">
          <b>{{ $title }}</b>
          @if ($tabs)
            @if ($title) <x-ui.v-divider mx=2 /> @endif
            {{ $tabs }}
          @endif
        </div>
      </div>
        
      <div id="right" class="d-flex align-items-center gap-2">
        @if ($option)
          <x-ui.v-divider />
          {{ $option }}
        @endif  
      </div>
    </div>
  @endif

  <div class="card-body flex-grow-1 d-flex flex-column @if($resetP)p-0 @endif @if($overflow)overflow-auto @endif">
      {{ $slot }}
  </div>
</div>