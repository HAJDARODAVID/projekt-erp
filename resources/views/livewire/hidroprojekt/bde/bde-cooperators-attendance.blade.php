<div>
    <div id="cooperatorsComponent">
        <h1 class="h6"><b>Kooperanti na gradilištu</b></h1>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <i class="bi bi-people-fill" style="color: red;"></i>&nbsp : &nbsp
                <b style="color: red;">{{ $workerCount }}</b>
            </div>
            <div class="col d-flex justify-content-center"> <button class="btn btn-success btn-sm" onclick="showAddCooperatorsModule()">POPIS RADNIKA</button></div>
        </div>
        <hr>
    </div>

    <div id="cooperatorsModule" style="display: none">

        <h1 class="h5"><b class="">Radni sati kooperanta</b></h1>
        <hr>
        <div class="row">
            <div class="col col-md-5">
                <button class="btn btn-success btn-sm" onclick="showAddCooperatorsToAddendanceModal()">DODAJ KOOPERANTA</button>
            </div>
        </div>
        <hr>

        @livewire('hidroProjekt.bde.bde-co-op-attendance-table',[
            'record' => $record,
        ])
        


        <!-- Modal => add cooperators -->
        <div class="modal" id="addCooperatorsToAttendance" style="display: none">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Popis kooperanta</h5>
                </div>
                <div class="modal-body">
                @livewire('hidroProjekt.bde.bde-add-co-op-worker-to-attendance-table', [
                    'theme' => "bootstrap-5"])
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAddCooperatorsToAddendanceModal()">ZATVORI</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
        function showAddCooperatorsToAddendanceModal(){
          document.getElementById('addCooperatorsToAttendance').style.display = "block";
        }
      
        function closeAddCooperatorsToAddendanceModal(){
          document.getElementById('addCooperatorsToAttendance').style.display = "none";
        }
      
        function hideShowTable(idTable, idBtn){
          let element = document.getElementById(idTable); 
          let btnToggle = document.getElementById(idBtn); 
          if(element.style.display == ""){
            element.style.display = "none";
            btnToggle.innerHTML = "PRIKAŽI RADNIKE"
          }else{
            element.removeAttribute("style");
            btnToggle.innerHTML = "SAKRIJ RADNIKE"
          } 
        }
    </script>
</div>
