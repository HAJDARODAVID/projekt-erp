<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Hidro-Projekt: ADM</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link rel="icon" href="{{ url('/images/hpIcon.png') }}" type="image/x-icon"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/snowflake.css') }}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="{{ url('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ url('css/customStyle.css') }}" rel="stylesheet">
    
  </head>
  <body>
    <script>
      function fadeAway(id){
        let milliseconds = 3000;
        setTimeout(function () {
            document.getElementById(id).remove();
        }, milliseconds);
      }
    </script>
    <script>
        function setDashBoardCardBodyHeight(div){
            element = document.getElementById(div);
            console.log(element.clientHeight);
            
            element_body = document.getElementById(div+'_body');
            element_body.style.height = (element.clientHeight-40)+"px"; 
            console.log(element.clientHeight+"px");
            
        }

        function toggleMenuAction(){
          element = document.getElementById('main-menu-container');
          element.classList.toggle("d-md-block");
        }
    </script>

    <div class="d-flex flex-column min-vh-100">
      @php $title = isset($pageTitle) ? $pageTitle : NULL; @endphp
      <x-ui.layout.header :pageTitle=$title />
      <div class="flex-grow-1 d-flex">
        <div class="col-md-2 col-lg-2 d-md-block collapse bg-light flex-grow-1" id="main-menu-container">
          <div class="d-flex flex-column position-sticky  pt-2">
            @livewire('main-menu') 
            @livewire('my-profile-component')
          </div>
        </div>
        <div class="col-10 flex-grow-1 d-flex flex-column py-2">
          @yield('content')
          @livewire('alert-modal')
          @livewire('exception-modal')
        </div>
      </div>
    </div>

    @livewireScripts
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ url('js/dashboard.js') }}"></script>
    <script>
      Livewire.on('focus-this-input',() => {
        console.log(document.getElementById('qr-input'));
        
          document.getElementById('qr-input').focus()
      }) 
    </script>
  </body>
</html>
