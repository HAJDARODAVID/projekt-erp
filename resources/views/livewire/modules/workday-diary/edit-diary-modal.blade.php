<div>
    <x-ui.btn type="pri.sm" icon="pen" wClickMethod="openModal" />
    <x-ui.modal :modalStatus=$modalStatus  size="l">
        <x-slot:title>DNEVNIK RADA: #{{ $row->id }}</x-slot:title>
        <x-ui.card :noBodyPadding=TRUE loading="diaryInfo" :border=FALSE>
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
                            <div class="d-flex justify-content-center">
                                <i>Promjena tipa primjenit će se na prisustvo radnika</i>
                            </div>
                            
                        </div>
                        <hr>
                        <x-ui.select :options=$constructionSites label="Gradilište" initOption="Gradilište..." class="form-select-sm {{ isset($error['consId']) ?  'is-invalid' : NULL }} {{ isset($save['consId']) ?  'is-valid' : NULL }}" wModel="diaryInfo.consId" />
                        <div class="row mt-2">
                            <div class="col"><x-ui.select :options=$groupLeaders label="Poslovođa" initOption="Poslovođa..." class="form-select-sm {{ isset($error['gLeaderId']) ?  'is-invalid' : NULL }} {{ isset($save['gLeaderId']) ?  'is-valid' : NULL }}" wModel="diaryInfo.gLeaderId" /></div>
                            <div class="col"><x-ui.input class="form-select-sm {{ isset($error['date']) ?  'is-invalid' : NULL }} {{ isset($save['date']) ?  'is-valid' : NULL }}" label="Datum" type="date" wModel="diaryInfo.date" wModelEvent="live"/></div>
                        </div>
                        <hr>
                        <div class="mt-2"><x-ui.select :options=$companyCars label="Vozilo" initOption="Vozilo..." class="form-select-sm {{ isset($error['carId']) ?  'is-invalid' : NULL }} {{ isset($save['carId']) ?  'is-valid' : NULL }}" wModel="diaryInfo.carId" /></div>
                        {{-- TODO: treba sloziti da se moze upisati kilometraža --}}
                        {{-- @isset($diaryInfo['carId'])
                            @if($diaryInfo['carId'])
                                <div class="row mt-1">
                                    <div class="col-md"><x-ui.input label="Početno stanje"  size="sm" append="km"/></div>
                                    <div class="col-md"><x-ui.input label="Završno stanje"  size="sm" append="km"/></div>
                                </div>
                            @endif
                        @endisset --}}
                        <hr>
                        <div class="mt-2">
                            <label>Komentar</label>
                            <textarea class="form-control no-border-radius" style="width: 100%" rows="5" wire:model.blur='diaryInfo.comment'></textarea>
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </x-ui.card>
    </x-ui.modal>
</div>
