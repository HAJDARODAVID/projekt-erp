<div class="modal helvetica modal-bg-blur" style="display: @isset($modalStatus)@if ($modalStatus) block @else none @endif @endisset;" @if($id) id="{{ $id }}" @endif @if($wKey) wire:key="{{ $wKey }}" @endif>
  <div class="modal-dialog @if($size) modal-{{$size}} @endif" >
    <div class="modal-content" style="border-radius: 0px">
      <div class="modal-header">
        <h5 class="modal-title">{{ mb_strtoupper($title) }}</h5>
        <x-ui.btn type="dar.sm" icon="x-lg" :wClickMethod=$closeModelMethod />
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div>
      @if ($footerRight || $footerLeft)
        <div class="modal-footer d-flex justify-content-between">
          <div class="">{{$footerLeft}}</div>
          <div class="d-flex gap-2">{{$footerRight}}</div>
        </div>
      @endif
    </div>
  </div>
</div>
