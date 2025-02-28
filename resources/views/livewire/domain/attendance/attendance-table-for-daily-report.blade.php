<div class="px-4 pt-1">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>IME / PREZIME</th>
            <th>SATI</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($attendance as $att)
            <tr>
                <td>{{ $att->getWorkerInfo->firstName }} {{ $att->getWorkerInfo->lastName }}</td>
                <td>
                    @if ($att->work_hours) 
                        {{ $att->work_hours }} 
                    @else
                        @if ($att->absence_reason) {{ $arst[$att->absence_reason]}} @endif   
                    @endif        
                </td> 
                <td>
                    <button class="btn btn-danger btn-sm p-0 px-1" wire:click='removeHpAttendance({{ $att->id }})'><i class="bi bi-trash p-0 m-0"></i></button>
                </td>
            </tr>  
            @endforeach
            @foreach ($attendanceCoOp as $attCoOp)
                <tr>
                    <td>{{ $attCoOp->getWorkerInfo->firstName }} {{ $attCoOp->getWorkerInfo->lastName }} [{{ $attCoOp->getWorkerInfo->getCoOpInfo->name }}]</td>
                    <td>{{ $attCoOp->work_hours }}</td> 
                    <td>
                        <button class="btn btn-danger btn-sm p-0 px-1" wire:click='removeCoOpAttendance({{ $attCoOp->id }})'><i class="bi bi-trash p-0 m-0"></i></button>
                    </td>
                </tr>  
            @endforeach
        </tbody>
      </table>
    </div>
  </div>