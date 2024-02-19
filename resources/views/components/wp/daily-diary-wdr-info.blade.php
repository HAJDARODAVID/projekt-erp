<div>
    <div class="row">
    <div class="col">
        <p class="h6">Poslovođa:</p>
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="firstName">Ime</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $groupLeader->getWorker->firstName }}" disabled>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="lastName">Prezime</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $groupLeader->getWorker->lastName }}" disabled>
                </div> 
            </div>
        </div>

        <p class="h6">Gradilište:</p>
        <div class="row mb-3">
            <div class="form-group">
            <label for="name">Naziv gradilišta</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $constSite->name }}" disabled>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="town">Mjesto</label>
                    <input type="text" class="form-control" id="town" name="town" value="{{ $constSite->town }}" disabled>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="street">Ulica</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{ $constSite->street }}" disabled>
                </div> 
            </div>
        </div>

        <p class="h6">Vozilo:</p>
        <div class="row mb-1">
            <div class="col">
            <div class="form-group">
                <label for="car_plates">Registracijske oznake</label>
                <input type="text" class="form-control" id="car_plates" name="car_plates" value="@if(isset($car)) {{ $car->car_plates }} @endif" disabled>
            </div>
            </div>
            <div class="col">
            <div class="form-group">
                <label for="brand">Marka</label>
                <input type="text" class="form-control" id="brand" name="brand" value="@if(isset($car)) {{ $car->brand }} @endif" disabled>
            </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="@if(isset($car)) {{ $car->model }} @endif" disabled>
                </div> 
            </div>
        </div>

        @if ($carMileage != NULL)
        <div class="row mb-3">
        <div class="col">
            <div class="form-group">
            <label for="star_mileage">Početno(km)</label>
            <input type="text" class="form-control" id="star_mileage" name="star_mileage" value="{{ $carMileage->start_mileage }}" disabled>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="end_mileage">Završno(km)</label>
                <input type="text" class="form-control" id="end_mileage" name="end_mileage" value="{{ $carMileage->end_mileage }}" disabled>
            </div> 
        </div>
        <div class="col">
            <div class="form-group">
                <label for="diff">Pređeno(km)</label>
                <input type="text" class="form-control" id="diff" name="diff" value="{{ $carMileage->end_mileage - $carMileage->start_mileage }}" disabled>
            </div> 
        </div>  
        </div>
        @endif
        
        <p class="h6">Dnevnik radova:</p>
        <div class="row mb-3">
            <textarea class="form-control" id="job_description" rows="12" style="resize: none;" disabled>{{ $stringLog }}</textarea>
        </div>
    </div>

    <div class="col">
        <p class="h6">Pisustvo radnika[Hidro-Projekt]:</p>
        <table class="table">
        <thead>
            <tr>
            <td><b>Ime / Prezime</b></td>
            <td><b>Sati</b></td>
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
                        {{ app/Models/AttendanceModel::ABSENCE_REASON_SHT_TXT[$att->absence_reason]}}
                    @endif
                    
                </td> 
            </tr>  
            @endforeach
        </tbody>
        </table>
        <hr>
        <p class="h6">Pisustvo radnika[Kooperanti]:</p>
        <table class="table">
        <thead>
            <tr>
            <td><b>Ime / Prezime</b></td>
            <td><b>Grupa</b></td>
            <td><b>Sati</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendanceCoOp as $attCoOp)
            <tr>
                <td>{{ $attCoOp->getWorkerInfo->firstName }} {{ $attCoOp->getWorkerInfo->lastName }}</td>
                <td>{{ $attCoOp->getWorkerInfo->getCoOpInfo->name }}</td>
                <td>{{ $attCoOp->work_hours }}</td> 
            </tr>  
            @endforeach
        </tbody>
        </table>
        
    </div>
    </div>
</div>