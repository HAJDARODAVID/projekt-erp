<x-ui.card.basic-card>
    <x-slot name='title'>{{ $worker->fullName }}</x-slot>
    <x-slot name='tabs'> <x-ui.nav.tabs :tabs=$tabs :selectedTab=$selectedTab py="1" /></x-slot>

    <x-ui.nav.tab-content tabKey=0 :selectedTab=$selectedTab >
        Kalendar
    </x-ui.nav.tab-content>
    <x-ui.nav.tab-content tabKey=1 :selectedTab=$selectedTab >
        <div class="card" style="width: 18rem;">
            <div class="card-header">
              Featured
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="d-flex gap-2">
                    <div class="">PON</div>
                    <x-ui.v-divider />
                    <div class="">10.03.2025.</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="d-flex gap-2">
                    <div class="">UTO</div>
                    <x-ui.v-divider />
                    <div class="">11.03.2025.</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="d-flex gap-2">
                    <div class="">SRI</div>
                    <x-ui.v-divider />
                    <div class="">12.03.2025.</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="d-flex gap-2">
                    <div class="">ČET</div>
                    <x-ui.v-divider />
                    <div class="">13.03.2025.</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="d-flex gap-2">
                    <div class="">PET</div>
                    <x-ui.v-divider />
                    <div class="">14.03.2025.</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="d-flex gap-2">
                    <div class="">SUB</div>
                    <x-ui.v-divider />
                    <div class="">15.03.2025.</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="d-flex gap-2">
                    <div class="">NED</div>
                    <x-ui.v-divider />
                    <div class="">16.03.2025.</div>
                </div>
              </li>
            </ul>
        </div>
    </x-ui.nav.tab-content>

    <x-ui.nav.tab-content tabKey=2 :selectedTab=$selectedTab >
        <div class="row">
          <div class="col-md-3">
            <b>Radna evidencija / sati po danu:</b>
            <hr>
            <div class="form-group mb-2">
              <label>Datum</label>
              <input type="date" class="form-control" wire:model='date'>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <b>Prisustvo</b>
              <div class="flex-grow-1 ms-2" style="border-bottom: 1px solid #999999;"></div>
              <button class="btn btn-danger p-0 mx-2" style="height: 15px; width: 15px"></button>
            </div>
            <div class="form-group mb-2">
              <label>Radna evidencija</label>
              <select id="disabledSelect" class="form-control">
                <option>Disabled select</option>
              </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
              <div class="form-group mb-3">
                <label>Radni sati / odsutnost</label>
                <input type="text" class="form-control">
              </div>
              <button class="btn btn-success" style="height: 40px">GO</button>
              <button class="btn btn-success" style="height: 40px">BO</button>
              <button class="btn btn-success" style="height: 40px">BL</button>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <b>Prisustvo</b>
              <div class="flex-grow-1 ms-2" style="border-bottom: 1px solid #999999;"></div>
              <button class="btn btn-danger p-0 mx-2" style="height: 15px; width: 15px"></button>
            </div>
            <div class="form-group mb-2">
              <label>Radna evidencija</label>
              <select id="disabledSelect" class="form-control">
                <option>Disabled select</option>
              </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
              <div class="form-group mb-3">
                <label>Radni sati / odsutnost</label>
                <input type="text" class="form-control">
              </div>
              <button class="btn btn-success" style="height: 40px">GO</button>
              <button class="btn btn-success" style="height: 40px">BO</button>
              <button class="btn btn-success" style="height: 40px">BL</button>
            </div>
          </div>
        </div>
    </x-ui.nav.tab-content>
</x-ui.card.basic-card>
