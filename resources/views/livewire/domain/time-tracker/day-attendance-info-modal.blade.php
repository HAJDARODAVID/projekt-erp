<div>
    <x-modal :show=$show :blur=TRUE>
        <x-slot:mainTitle>@isset($worker) #{{ $worker->id }} | {{ $worker->fullName }} @endisset</x-slot:mainTitle>
        <x-slot:secTitle>@isset($worker) {{ $date }} @endisset</x-slot:secTitle>
        <x-slot:headerBtn>
            <div class="d-flex gap-1">
                <button class="btn btn-primary btn-sm shadow" wire:click='closeModal()'><b>GO</b></button>
                <button class="btn btn-warning btn-sm shadow" wire:click='closeModal()'><b>BO</b></button>
                <button class="btn btn-sm shadow" style="background-color: #976EDB" wire:click='closeModal()'><b>BL</b></button>
                <x-v-divider />
                <button class="btn btn-dark btn-sm shadow" wire:click='closeModal()'>X</button>
            </div>
        </x-slot:headerBtn>
        <b>Upisano prisustvo:</b>
        <table class="table">
            <thead><tr><th>Gradilište</th><th>Satnica</th><th></th></tr></thead>
            <tbody>
                @isset($attendance)
                    @foreach ($attendance as $attID => $att)
                        <tr>
                            <td>
                                <select class="form-select form-select-sm" wire:model='attendance.{{ $attID }}.wdrID'>
                                    <option value="NULL">Nije dodijeljeno radnoj evidenciji</option>
                                    @foreach ($wdr as $key => $oneWdr)
                                        <option value="{{ $key }}">{{ $oneWdr['jobSite'] }} | {{ $oneWdr['groupLeader'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <input type="number" class="form-control form-control-sm" style="width: 75px" wire:model='attendance.{{ $attID }}.work_hours'
                                        placeholder="@if($att['absence_reason'] != NULL) {{ $absenceReasonShtTxt[$att['absence_reason']] }} @endif">
                                    <button class="btn btn-danger btn-sm " wire:click='deleteAttendance({{ $attID }})'><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset 
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
                            <select class="form-select form-select-sm">
                                <option value="NULL">Odaberi...</option>
                                <option value="new_wdr"><b>Novi zapis</b></option>
                                @isset($wdr)
                                    @foreach ($wdr as $key => $oneWdr)
                                        <option value="{{ $key }}">{{ $oneWdr['jobSite'] }} | {{ $oneWdr['groupLeader'] }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @if (TRUE)
                                <select class="form-select form-select-sm mt-2">
                                    <option value="NULL">Odaberi gradilište...</option>
                                    @isset($wdr)
                                        @foreach ($wdr as $key => $oneWdr)
                                            <option value="{{ $key }}">{{ $oneWdr['jobSite'] }} | {{ $oneWdr['groupLeader'] }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end align-items-center gap-1 ">
                            <input type="number" class="form-control form-control-sm" style="width: 75px">
                            <button class="btn btn-danger btn-sm " ><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </x-modal>
    
</div>
