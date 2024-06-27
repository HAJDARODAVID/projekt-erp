<div class="modal" id="changeWorkerHRate" style="display: @if($showModal) block @endif">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">
                    Promjena satnice radnika
                </h6>
            </div>
            <div class="modal-body">
                @isset($worker)
                    Da li želite promjeniti satnicu u matičnim podacima: <br>
                    Radnik: {{ $worker->fullName }} <br>
                    Promjena: 
                    @if (is_null($worker->getWorkerBasicPayrollInfo->h_rate))
                        {{ number_format(0,2) }}
                    @else
                        {{ $worker->getWorkerBasicPayrollInfo->h_rate }}
                    @endif
                    --> {{ number_format($newValue,2) }}
                @endisset
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" wire:click='changeBtn(1)'>PROMJENI</button>
                <button class="btn btn-primary" wire:click='changeBtn()'>ZADRŽI SAMO ZA OBRAČUN</button>
            </div>

        </div>
    </div>
</div>