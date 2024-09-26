<div class="mt-auto px-2 pb-3">
  <hr>
  <div class="dropdown" onmouseover="document.getElementById('profil-menu').classList.add('show');">
    {{-- ADD LATER TO SPAN --> dropdown-toggle --}}
    <span class="d-flex align-items-center text-decoration-none">
      <img src="{{ asset('images/user_avatar/default.png') }}" alt="" width="32" height="32" class="rounded-circle me-2">
      <strong >
        {{ $userName }}
      </strong>
    </span>
    {{-- <ul id="profil-menu" class="dropdown-menu text-small text-black shadow mx-1 mb-1" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(0px, -34px);" onmouseout="document.getElementById('profil-menu').classList.remove('show');">
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Sign out</a></li>
    </ul> --}}
  </div>
</div>
