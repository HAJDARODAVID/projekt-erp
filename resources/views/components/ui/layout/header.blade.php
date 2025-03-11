<nav class="navbar navbar-dark bg-dark px-3 sticky-top">
  <x-ui.layout.nav-menu />
  <div class="flex-grow-1 px-2">
    <p class="text-uppercase font-weight-bold text-light m-0" style="-webkit-app-region: drag;">
      <b>
        HIDRO-PROJEKT @if($pageTitle) | {{ $pageTitle }}@endif
      </b>
    </p>
  </div>

  {{-- @livewire('ui.close-window-btn') --}}
</nav>