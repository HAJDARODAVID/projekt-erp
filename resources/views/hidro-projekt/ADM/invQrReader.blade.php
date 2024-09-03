@extends('layouts.mainAdminLayout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">QR SKENER - INVENTURA:</h1>
        <a href="{{ route('hp_activeInventoryChecking', $activeInventory->inv_name) }}" class="btn btn-dark btn-lg d-flex align-items-center mx-1" ><i class="bi bi-arrow-return-left"></i></a>
    </div>
  
    <div class="container">
        <div id="you-qr-result"></div>
        @livewire('hidroProjekt.adm.add-to-inv-list-qr-reader-modal')
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
                // open-qr-inventory-modal
                // Livewire.emit('open-qr-inventory-modal')
            }

            var htmlScanner = new Html5QrcodeScanner(
                "my-qr-reader", {fps:10, qrbox:250}
            )
            htmlScanner.render(onScanSuccess)
        })
    </script>
@endsection