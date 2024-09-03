@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">QR SCANER:</h1>
    </div>
  
    <div class="container">
        <div id="you-qr-result"></div>
        <div class="d-flex justify-content-center">
            <div id="my-qr-reader" style="width:500px"></div>
        </div>
    </div>

    <script src="http://unpkg.com/html5-qrcode"></script>
    <script>
        function domReady(fn){
            if(document.readyState === "compleate" || document.readyState === "interactive"){
                setTimeout(fn,1)
            }else{
                document.addEventListener("DOMContentLoaded", fn)
            }   
        }

        domReady(function(){
            var myqr = document.getElementById('you-qr-result')
            var lastResult, countResults = 0;

            function onScanSuccess(decodeText, decodeResult){
                alert("Your QR is : " + decodeText, decodeResult)
            }

            var htmlScanner = new Html5QrcodeScanner(
                "my-qr-reader", {fps:10, qrbox:250}
            )
            htmlScanner.render(onScanSuccess)
        })
    </script>
@endsection