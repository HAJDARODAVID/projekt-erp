<div>
    <x-modal :show=$show :blur=TRUE size='lg' z=9999>
        <x-slot:mainTitle>@isset($worker) #{{ sprintf('%04d', $worker->id) }} | {{ $worker->fullName }} @endisset</x-slot:mainTitle>
        <x-slot:secTitle>@isset($worker) {{ $date }} @endisset</x-slot:secTitle>
        <x-slot:headerBtn>
            <div class="d-flex gap-1">
                <button class="btn btn-primary btn-sm shadow" wire:click="addAbsence({{ App\Models\AttendanceModel::ABSENCE_REASON_PAID_LEAVE }})"><b>GO</b></button>
                <button class="btn btn-warning btn-sm shadow" wire:click='addAbsence({{ App\Models\AttendanceModel::ABSENCE_REASON_SICK_LEAVE }})'><b>BO</b></button>
                <button class="btn btn-sm shadow" style="background-color: #976EDB" wire:click='addAbsence({{ App\Models\AttendanceModel::ABSENCE_REASON_HOLIDAY }})'><b>BL</b></button>
                <x-v-divider />
                <button class="btn btn-dark btn-sm shadow" wire:click='closeModal()'>X</button>
            </div>
        </x-slot:headerBtn>
        <b>Upisano prisustvo:</b>
        <table class="table">
            <thead><tr><th>Gradilište / odsutnost</th><th>Satnica</th><th></th></tr></thead>
            <tbody>
                @isset($attendance)
                    @foreach ($attendance as $attID => $att)
                        <tr>
                            <td>
                                <select class="form-select form-select-sm @isset($saved[$attID]['wdrID']) is-valid @endisset" wire:model.change='attendance.{{ $attID }}.wdrID'>
                                    <option value="NULL">Nije dodijeljeno radnoj evidenciji</option>
                                    @foreach ($wdr as $key => $oneWdr)
                                        <option value="{{ $key }}">{{ $oneWdr['jobSite'] }} | {{ $oneWdr['groupLeader'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between gap-1">
                                    <div class="d-flex gap-1">
                                        <input type="number" class="form-control form-control-sm @isset($saved[$attID]['work_hours']) is-valid @endisset" style="width: 100px" wire:model.blur='attendance.{{ $attID }}.work_hours'
                                        placeholder="@if($att['absence_reason'] != NULL) {{ $absenceReasonShtTxt[$att['absence_reason']] }} @endif" @if($att['absence_reason'] != NULL) disabled @endif>
                                        @if($att['absence_reason'] == NULL)
                                            <select class="form-select-custom form-select form-select-sm @isset($saved[$attID]['type']) is-valid @endisset" style="width: 100px" wire:model.live='attendance.{{ $attID }}.type'>
                                                @foreach (App\Models\WorkingDayRecordModel::WORK_TYPE as $typeKey => $type)
                                                    <option value="{{ $typeKey }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <button class="btn btn-danger btn-sm " wire:click='deleteAttendance({{ $attID }})'><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
                @if((!$attendance))
                    <tr><td><i>Nema upisa prisustva</i></td><td></td></tr>
                @endif
            </tbody>
        </table>
        <hr>
        <b>Upis prisustva na gradilištu:</b>
        <table class="table">
            <thead><tr><th>Gradilište</th><th>Satnica</th><th></th></tr></thead>
            <tbody>
                <tr>
                    <td>
                        <div class="align-items-center">
                            <select class="form-select form-select-sm @isset($error['wdr']) is-invalid @endisset" wire:model.live='newHours.wdr'>
                                <option value="NULL">Odaberi...</option>
                                <option value="new_wdr">Novi zapis</option>
                                @isset($wdr)
                                    @foreach ($wdr as $key => $oneWdr)
                                        <option value="{{ $key }}">{{ $oneWdr['jobSite'] }} | {{ $oneWdr['groupLeader'] }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @if ($newHours['wdr'] == 'new_wdr')
                                <select class="form-select form-select-sm mt-2 @isset($error['cs']) is-invalid @endisset" wire:model.live='newHours.cs'>
                                    <option value="">Odaberi gradilište...</option>
                                    @isset($wdr)
                                        @foreach ($jobSites as $jobSite)
                                            <option value="{{ $jobSite->id }}">{{ $jobSite->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center gap-1 ">
                            <input type="number" class="form-control form-control-sm @isset($error['newHours']) is-invalid @endisset" style="width: 100px" wire:model.live='newHours.hours'>
                            <button class="btn btn-success btn-sm " wire:click='addToAttendance()'><b>+</b></button>
                        </div>
                        @if ($newHours['wdr'] == 'new_wdr')
                            <select class="form-select form-select-sm mt-2" wire:model.live='newHours.type' style="width: 100px">
                                @isset($wdr)
                                    @foreach (App\Models\WorkingDayRecordModel::WORK_TYPE as $typeKey => $type)
                                        <option value="{{ $typeKey }}">{{ $type }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </x-modal>
    
</div>
