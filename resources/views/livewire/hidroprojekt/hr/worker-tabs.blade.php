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
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="town">Mjesto</label>
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="mob">Broj mobitela</label>
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="zip">Poštanski broj</label>
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="county">Županija</label>
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>
                @break
            @case(2)
                testing tab 2
                @break
        
            @default
                
        @endswitch
    </div>    
</div>
