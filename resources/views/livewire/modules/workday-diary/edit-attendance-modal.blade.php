<div>
    <x-ui.btn type="pri.sm" icon="people" wClickMethod="openModal" />

    <x-ui.modal :modalStatus=$modalStatus  size="l">
        <x-slot:title>PRISUSTVO: #{{ $row->id }}</x-slot:title>
        <x-slot:subtitle>
            <b>Gradilište:</b> {{ $row->name }} <br>
            <b>Datum:</b> {{ $row->date }}   
        </x-slot:subtitle>
        
        <x-ui.card loading="addWorkerToAttendance, removeWorkerFromAttendance, saveAttendance">
            <div class="row">
                <div class="col-md-6 d-flex gap-2">
                    <x-ui.input placeholder="Traži..." size="sm" :removeAddOnXP=TRUE wire:model.live.debounce.250ms='workerSearch'> 
                        @if ($workerSearch != NULL || $workerSearch != "")
                            <x-slot:append>
                                <x-ui.btn type="lig.sm" icon="trash" wClickMethod="resetSearchInput" />
                            </x-slot:append>
                        @endif
                    </x-ui.input>
                    {{-- TODO: ADD search modal here --}}
                    {{-- <div class="vr"></div>
                    <x-ui.btn type="lig.sm" icon="search" /> --}}
                </div>
            </div>
            <hr>
            @if($workerSearch)
                <div class="d-flex flex-wrap gap-2 my-2">
                    @foreach ($workers['myWorkers'] as $worker)
                        <x-ui.btn type="lig.sm" wClickMethod="addWorkerToAttendance" wClickParam="{{$worker->id}}, {{$worker->fullName}}, myWorkers">{{ $worker->fullName }}</x-ui.btn>
                    @endforeach
                    @foreach ($workers['cooperators'] as $worker)
                        <x-ui.btn type="lig.sm" wClickMethod="addWorkerToAttendance" wClickParam="{{$worker->id}}, {{$worker->fullName}}-{{ $worker->getCoOpInfo->name }}, cooperators">{{ $worker->fullName }}-{{ $worker->getCoOpInfo->name }} </x-ui.btn>
                    @endforeach
                </div>
                <hr>
            @endif
            @isset($attendance)
            <table class="table table-sm" style="table-layout: auto !Important; width: 100% !Important;">
                <thead>
                    <th style="white-space: nowrap;">Ime / prezime</th>
                    <th>Sati</th>
                    <th style="white-space: nowrap;"></th>
                </thead>
                <tbody>
                    @isset($attendance['myWorkers'])
                        @foreach ($attendance['myWorkers'] as $workerID => $workerData)
                            <tr>
                                <td>@if($workerData['att_id'] == NULL)* @endif{{ $workerData['name'] }}</td>
                                <td style="width: 80px"><x-ui.input type="number" width=10 size="sm" wModel='attendance.myWorkers.{{ $workerID }}.att_time' /></td>
                                <td style="text-align: right">
                                    <x-ui.btn type="lig.sm" icon="trash" wClickMethod="removeWorkerFromAttendance" wClickParam="{{ $workerID }}, myWorkers"/>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    @isset($attendance['cooperators'])
                            <tr><td colspan="3" style="text-align: center;"><i>*** Kooperanti ***</i></td></tr>
                        @foreach ($attendance['cooperators'] as $workerID => $workerData)
                            <tr>
                                <td>{{ $workerData['name'] }}</td>
                                <td><x-ui.input type="number" width=10 size="sm" wModel='attendance.cooperators.{{ $workerID }}.att_time' /></td>
                                <td style="text-align: right">
                                    <x-ui.btn type="lig.sm" icon="trash" wClickMethod="removeWorkerFromAttendance" wClickParam="{{ $workerID }}, cooperators" />
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            @endisset
            @empty($attendance)
                <div class="d-flex justify-content-center"><i>Nema zapisa radnika u prisustvu</i></div>
            @endempty
        </x-ui.card>
        <x-slot:footerRight><x-ui.btn type="suc.sm" icon="save" wClickMethod="saveAttendance" /></x-slot:footerRight>
    </x-ui.modal>
</div>
