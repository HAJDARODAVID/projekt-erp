<div>
    <x-ui.btn type="suc.sm" icon="file-earmark-plus" wClickMethod="openModal"></x-ui.btn>
    <x-ui.modal title='novi dnevnik rada' :modalStatus=$modalStatus  size="lg">
        <x-ui.card :noBodyPadding=TRUE loading="createNewDiary" :border=FALSE>
            <div class="row">
                <div class="col-md">
                    <x-ui.card title="INFO GRADILIŠTA">
                        <x-ui.select :options=$constructionSites label="Gradilište" initOption="Odaberi" class="form-select-sm" wModel="diaryInfo.consId" />
                        <div class="mt-2"><x-ui.select :options=$constructionSites label="Poslovođa" initOption="Odaberi" class="form-select-sm" wModel="diaryInfo.gLeader" /></div>
                        <div class="mt-2"><x-ui.select :options=$companyCars label="Vozilo" initOption="Odaberi" class="form-select-sm" wModel="diaryInfo.car" /></div>
                        <div class="row mt-3">
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
                        <div class="mt-2">
                            <label>Komentar</label>
                            <textarea class="form-control no-border-radius" style="width: 100%" rows="5"></textarea>
                        </div>
                    </x-ui.card>
                </div>
                <div class="col-md">
                    <x-ui.card title="PRISUSTVO"></x-ui.card>
                </div>
            </div>
        </x-ui.card>
        
        <x-slot:footerRight><x-ui.btn type="suc" icon="save" wClickMethod="createNewDiary" /></x-slot:footerRight>
    </x-ui.modal>
</div>
