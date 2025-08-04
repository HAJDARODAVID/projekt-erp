<div>
    <x-ui.btn type="suc.sm" icon="file-earmark-plus" wClickMethod="openModal"></x-ui.btn>
    <x-ui.modal title='novi dnevnik rada' :modalStatus=$modalStatus  size="xl">
        <x-ui.card :noBodyPadding=TRUE loading="createNewDiary" :border=FALSE>
            <div class="row">
                <div class="col-md">
                    <x-ui.card title="INFO GRADILIŠTA">
                        <div class="row">
                            @foreach (WorkdayTypes::bdeType() as $typeKey => $type)
                                <div class="col-md d-flex justify-content-center">
                                    <div class="">
                                        <div class="">{{ $type }}</div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" wire:model.live="diaryInfo.workdayType" value="{{ $typeKey }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <x-ui.select :options=$constructionSites label="Gradilište" initOption="Gradilište..." class="form-select-sm" wModel="diaryInfo.consId" />
                        <div class="row mt-2">
                            <div class="col"><x-ui.select :options=$groupLeaders label="Poslovođa" initOption="Poslovođa..." class="form-select-sm" wModel="diaryInfo.gLeaderId" /></div>
                            <div class="col"><x-ui.input class="form-select-sm {{ isset($error['date']) ?  'is-invalid' : NULL }}" label="Datum" type="date" wModel="diaryInfo.date" /></div>
                        </div>
                        <hr>
                        <div class="mt-2"><x-ui.select :options=$companyCars label="Vozilo" initOption="Vozilo..." class="form-select-sm" wModel="diaryInfo.carId" /></div>
                        @isset($diaryInfo['carId'])
                            <div class="row mt-1">
                                <div class="col-md"><x-ui.input label="Početno stanje"  size="sm" append="km"/></div>
                                <div class="col-md"><x-ui.input label="Završno stanje"  size="sm" append="km"/></div>
                            </div>
                        @endisset
                        <hr>
                        <div class="mt-2">
                            <label>Komentar</label>
                            <textarea class="form-control no-border-radius" style="width: 100%" rows="5"></textarea>
                        </div>
                    </x-ui.card>
                </div>
                <div class="col-md">
                    <x-ui.card title="PRISUSTVO" loading="addWorkerToAttendance, removeWorkerFromAttendance">
                        <div class="row"><div class="col-md-6 d-flex gap-2">
                            <x-ui.input placeholder="Traži..." size="sm" :removeAddOnXP=TRUE wire:model.live.debounce.250ms='workerSearch'> 
                                @if ($workerSearch != NULL || $workerSearch != "")
                                    <x-slot:append>
                                        <x-ui.btn type="lig.sm" icon="trash" wClickMethod="resetSearchInput" />
                                    </x-slot:append>
                                @endif
                                
                            </x-ui.input>
                            
                            <div class="vr"></div>
                            <x-ui.btn type="lig.sm" icon="search" />
                        </div></div>
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
                            <table class="table table-sm" style="table-layout: auto;">
                                <thead>
                                    <th>Ime prezime</th>
                                    <th>Sati</th>
                                    <th style="white-space: nowrap;"></th>
                                </thead>
                                <tbody>
                                    @isset($attendance['myWorkers'])
                                        @foreach ($attendance['myWorkers'] as $workerID => $workerData)
                                            <tr>
                                                <td>{{ $workerData['name'] }}</td>
                                                <td><x-ui.input width=10 size="sm" wModel='attendance.myWorkers.{{ $workerID }}.attTime' /></td>
                                                <td style="white-space: nowrap;">
                                                    <x-ui.btn type="lig.sm" icon="trash" wClickMethod="removeWorkerFromAttendance" wClickParam="{{ $workerID }}, myWorkers"/>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    @endisset

                                    @isset($attendance['cooperators'])
                                        @foreach ($attendance['cooperators'] as $workerID => $workerData)
                                            <tr>
                                                <td>{{ $workerData['name'] }}</td>
                                                <td><x-ui.input width=10 size="sm" wModel='attendance.cooperators.{{ $workerID }}.attTime' /></td>
                                                <td style="white-space: nowrap;">
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
                    
                </div>
            </div>
        </x-ui.card>
        {{ var_dump($attendance) }}
        
        <x-slot:footerRight><x-ui.btn type="suc" icon="save" wClickMethod="createNewDiary" /></x-slot:footerRight>
    </x-ui.modal>
</div>
