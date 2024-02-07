<div>
  <div id="attendanceComponent">
    <h1 class="h6"><b>Radnici na gradilištu</b></h1>
    <div class="row">
      <div class="col d-flex justify-content-center">
        <i class="bi bi-people-fill" style="color: red;"></i>&nbsp : &nbsp
        <b style="color: red;">{{ $workerCount }}</b>
      </div>
      <div class="col d-flex justify-content-center"> <button class="btn btn-success btn-sm" onclick="showAddWorkersModule()">POPIS RADNIKA</button></div>
    </div>
    <hr>
  </div>

  <div  id="attendaceModule" style="display: none">
  <h1 class="h5"><b class="">Radni sati radnika</b></h1>

  <hr>
  <h1 class="h6"><b>Poslovođa:</b></h1>

  <table class="table">
    <thead>
      <tr>
        <th scope="row">Ime prezime</th>
        <td>Sati</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td scope="row">{{ $groupLeader->getWorker->firstName }} {{ $groupLeader->getWorker->lastName }}</td>
        <td>@livewire('hidroProjekt.bde.bde-group-leader-hours',[
        'record' => $record,
        ])</td>
      </tr>
    </tbody>
  </table>

  <hr>
  <div class="row">
    <div class="col">
      <h1 class="h6"><b>Radnici[Hidro-Projekt]:</b></h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <button class="btn btn-success btn-sm" onclick="showAddWorkerToAddendanceModal()">DODAJ RADNIKA</button>
    </div>
    <div class="col">
      <button class="btn btn-secondary btn-sm" onclick="hideShowTable('hidroWorkersTableBody','hidroToggleBtn')" id="hidroToggleBtn">SAKRIJ RADNIKE</button>
    </div>
  </div>

  @livewire('hidroProjekt.bde.bde-workers-in-attendance-table', [
    'record' => $record,
  ])

          <!-- Modal -->
  <div class="modal" id="addWorkerToAttendance" style="display: none">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Popis radnika</h5>
        </div>
        <div class="modal-body">
          @livewire('hidroProjekt.bde.bde-select-worker-for-attendance-table', [
            'theme' => "bootstrap-5"])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeAddWorkerToAddendanceModal()">ZATVORI</button>
        </div>
      </div>
    </div>
  </div>

  </div>

<script>
  function showAddWorkerToAddendanceModal(){
    document.getElementById('addWorkerToAttendance').style.display = "block";
  }

  function closeAddWorkerToAddendanceModal(){
    document.getElementById('addWorkerToAttendance').style.display = "none";
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
