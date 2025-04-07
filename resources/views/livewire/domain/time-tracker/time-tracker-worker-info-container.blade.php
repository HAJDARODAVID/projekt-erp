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
        Dan
    </x-ui.nav.tab-content>
</x-ui.card.basic-card>
