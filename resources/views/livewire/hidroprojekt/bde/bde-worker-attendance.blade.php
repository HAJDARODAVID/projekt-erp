<div>
    <div id="attendanceComponent">
        <h1 class="h6"><b>Radnici na gradilištu</b></h1>
        <div class="row">
            <div class="col d-flex justify-content-center"><i class="bi bi-people-fill"></i>&nbsp : &nbsp<b>8</b></div>
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
                <td scope="row">Tomislav Šoštarek</td>
                <td>@livewire('hidroProjekt.bde.bde-group-leader-hours',[
                    'record' => $record,
                ])</td>
              </tr>
            </tbody>
          </table>

        <h1 class="h6"><b>Radnici:</b></h1>

        {{-- <table class="table">
            <tbody>
              <tr>
                <th scope="row">{{ Auth::user()->name }} Šoštttarek</th>
                <td>
                    <input type="text" name="" id="" style="width: 50px">
                    
                </td>
              </tr>
            </tbody>
          </table> --}}
        
    </div>


</div>
