<div>
    <h1 class="h5"><b class="">Radni sati [Hidro-Projekt]</b></h1>
    <hr class="m-0 p-0 py-1">

    <table class="table" class="m-0 p-0">
        <thead>
          <tr> <th scope="row">Poslovođa</th> <td>Sati</td> </tr>
        </thead>
        <tbody>
          <tr>
            <td scope="row">{{ $user->getWorker->fullName }}</td>
            <td>
                <input type="number" class="form-control form-control-sm" style="width: 70px">
            </td>
          </tr>
        </tbody>
    </table>
    <hr class="m-0 p-0 py-2">

    <div class="d-flex justify-content-between align-items-center">
        <span class="text-sm mx-2"><b>Prisustvo</b></span>
        @livewire('domain.bde.main-work-report-modules.attendance.workers-table-modal')
    </div>
    @foreach ($attendance as $workerID => $worker)
      {{ $workerID }} - {{ $worker['name'] }} <br>
    @endforeach
</div>
