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
        <span class="mx-2"><b>Prisustvo</b></span>
        @livewire('domain.bde.main-work-report-modules.attendance.workers-table-modal')
    </div>
    
    <div x-data="{attendance: $persist(@entangle('attendance'))}" x-init="$wire.dispatch('get-attendance-for-db')">
      @isset($attendance[$wdr['id']])
        <table class="table" class="m-0 p-0">
          <thead>
            <tr> <th scope="row">Radnik</th> <td>Sati</td> </tr>
          </thead>
          <tbody>
            @foreach ($attendance[$wdr['id']] as $workerID => $worker)
              <tr class="align-content-center">
                <td scope="row">{{ $worker['name'] }}</td>
                <td>
                    <div class="d-flex justify-content-end gap-1">
                      <input type="number" class="form-control form-control-sm" style="width: 50px" wire:model.blur='attendance.{{ $wdr['id'] }}.{{ $workerID }}.hours' placeholder="">
                      <x-v-divider />
                      <button class="btn btn-primary btn-sm p-0 px-1">GO</button>
                      <button class="btn btn-warning btn-sm p-0 px-1">BO</button>
                      <button class="btn btn-danger btn-sm p-0 px-1" wire:click='removeFromAttendance({{ $workerID }})'><i class="bi bi-trash"></i></button>
                    </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endisset
    </div>
</div>
