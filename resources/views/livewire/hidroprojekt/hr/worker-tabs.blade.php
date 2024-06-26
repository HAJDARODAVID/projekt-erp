<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist"> 
        @foreach ($tabs as $key => $tab)
            <li class="nav-item" role="presentation">
                <button class="nav-link @if ($key == $activeTab) active fw-bold @endif"
                    wire:click='changeActiveTab("{{ $key }}")'>
                    {{ $tab }}
                </button>
            </li> 
        @endforeach
    </ul>
    <div class="pt-2 px-5">
        @switch($activeTab)
            @case(1)
                <div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="street">Ulica</label>
                                <input type="text" class="form-control @isset($saveState['street']) is-valid @endisset" wire:model.blur='address.street'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="town">Mjesto</label>
                                <input type="text" class="form-control @isset($saveState['town']) is-valid @endisset" wire:model.blur='address.town'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="mob">Broj mobitela</label>
                                <input type="text" class="form-control @isset($saveState['mob']) is-valid @endisset" wire:model.blur='contact.mob'>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="zip">Poštanski broj</label>
                                <input type="text" class="form-control @isset($saveState['zip']) is-valid @endisset" wire:model.blur='address.zip'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="county">Županija</label>
                                <input type="text" class="form-control @isset($saveState['county']) is-valid @endisset" wire:model.blur='address.county'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control @isset($saveState['email']) is-valid @endisset" wire:model.blur='contact.email'>
                            </div>
                        </div>
                    </div>
                </div>
                @break
            @case(2)
                <div>
                    <b>Osnovne satnice/fix-isplata</b>
                    <div class="row mt-1 mb-2">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="h_rate">Satnica</label>
                                <input type="number" class="form-control @isset($saveState['h_rate']) is-valid @endisset" wire:model.blur='payrollInfo.h_rate'>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="fix_rate">Fiksna isplata</label>
                                <input type="number" class="form-control @isset($saveState['fix_rate']) is-valid @endisset" wire:model.blur='payrollInfo.fix_rate'>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <b>Dodatak na plaču</b>
                    <div class="row mt-1 mb-2">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="travel_exp">Putni troškovi</label>
                                <input type="number" class="form-control @isset($saveState['travel_exp']) is-valid @endisset" wire:model.blur='payrollInfo.travel_exp'>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="phone_exp">Troškovi mobitela</label>
                                <input type="number" class="form-control @isset($saveState['phone_exp']) is-valid @endisset" wire:model.blur='payrollInfo.phone_exp'>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <b>Isplata bonusa za rad</b>
                    <div class="row mt-1 mb-2">
                        <div class="col-3">
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" wire:model.blur='payrollInfo.bonus'>
                                <label class="form-check-label" for="bonus">
                                  Da li radnik može dobiti bonus? 
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @break
        
            @default
                
        @endswitch
    </div>    
</div>
