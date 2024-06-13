<div>
    {{-- In work, do what you enjoy. --}}
    <div class="modal" id="bookToStorageModal" style="display:  @if ($activeModal) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-start">
                    @if ($worker)
                        <div>
                            <div><h5 class="h5">Radnik: {{ $worker->firstName }} {{ $worker->lastName }}</span></div>
                            {{-- <div><h7 class="h7">Grupa: </span> </div> --}}
                            <div><h7 class="h7">Datum: {{ $attendanceDate }}</span> </div>
                        </div>
                    @endif
                    <button class="btn btn-dark" wire:click='closeModal()'>X</button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div class="gap-1">
                            <button class="btn btn-success" wire:click='setType(1)'><i class="bi bi-hammer"></i></button>
                            <button class="btn btn-success" wire:click='setType(2)'><i class="bi bi-cone-striped"></i></button>
                            <button class="btn btn-primary" wire:click=''>GO</button>
                            <button class="btn btn-warning" wire:click=''>BO</button>
                        </div>
                        @if($deleteAttendanceBtn)
                            <button class="btn btn-danger d-flex align-items-center"
                                id="deleteAll"
                                wire:click='delete()' 
                                wire:loading.attr='disabled'
                            ><i class="bi bi-trash"></i>
                            </button>
                        @endif
                        
                    </div>
                    
                    <hr>

                    <div style="display: @if (isset($type['wdr'])) block @else none @endif">
                        <b>Dnevnik rada:</b>
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 300px"><b>Radni dnevnik</b></th>
                                    <th><b>Sati</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($hours['work'])
                                    @foreach ($hours['work'] as $wdr => $data)
                                        <?php
                                            $data['key'] = $wdr;
                                            $data['type'] = 'work';
                                            $deleteArray = json_encode($data);
                                        ?>
                                        <tr>
                                            <td>
                                                <select class="form-control" wire:model.change='hours.work.{{ $wdr }}.wdr'>
                                                    <option value="">Odaberi dnevnik rada</option> 
                                                    @foreach ($wdrObj as $oneWdr)
                                                        <option value="{{ $oneWdr->id }}">{{ $oneWdr->getUser->name }} | {{ $oneWdr->getConstructionSite->name }}</option>    
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <input type="number" class="form-control" style="width: 100px" wire:model.blur='hours.work.{{ $wdr }}.hours'>
                                                    <button class="btn btn-danger btn-sm d-flex align-items-center"
                                                        wire:click='delete({{ $deleteArray }})' 
                                                        wire:loading.attr='disabled'
                                                    ><i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success mt-2" wire:click='addItem()'>+</button>
                        <hr>
                    </div>
                    
                    <div style="display: @if (isset($type['miscWork'])) block @else none @endif">
                        <b>Režijski sati:</b><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 300px"><b>Vrsta režija</b></th>
                                    <th><b>Sati</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($miscWorkList as $wdr => $title)
                                    <?php
                                        $data['key'] = $wdr;
                                        $data['type'] = 'misc';
                                        if(isset($hours['misc'])){
                                            $data = array_merge($data, $hours['misc'][$wdr]);
                                        }
                                        $deleteArray = json_encode($data);
                                    ?>
                                    <tr>
                                        <td>{{ $title }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <input type="number" class="form-control" style="width: 100px" wire:model.blur='hours.misc.{{ $wdr }}.hours'>
                                                <button class="btn btn-danger btn-sm d-flex align-items-center"
                                                    wire:click='delete({{ $deleteArray }})' 
                                                    wire:loading.attr='disabled'
                                                ><i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" wire:click='save()' wire:loading.attr='disabled'>SPREMI</button>
                </div>
            </div>
        </div>
    </div>

    <x-processing-modal target='openModal, mount, save'></x-processing-modal>
</div>
