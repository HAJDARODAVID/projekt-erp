<div>
    @if($displayIcon)
        @if ($icon)
            {!! $icon !!}
        @else
            <i class="bi bi-plus-square" style="cursor: pointer;padding: 0px 4px" wire:click='openModal'></i>
        @endif
    @endif

    <x-ui.modal :modalStatus=$modalStatus  size="l" >
        <x-ui.card :noBodyPadding=TRUE :border=FALSE >
            <div class="container " wire:key="calendar-container-{{ now() }}">
                <div class="calendar-container shadow no-border-radius">
                    <div class="calendar-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">April 2026</h2>
                        <div>
                            <button class="btn btn-outline-secondary btn-sm">&lt;</button>
                            <button class="btn btn-outline-primary btn-sm mx-2">Today</button>
                            <button class="btn btn-outline-secondary btn-sm">&gt;</button>
                        </div>
                    </div>

                    <div class="calendar-grid">
                        <div class="day-name">Mon</div>
                        <div class="day-name">Tue</div>
                        <div class="day-name">Wed</div>
                        <div class="day-name">Thu</div>
                        <div class="day-name">Fri</div>
                        <div class="day-name">Sat</div>
                        <div class="day-name">Sun</div>
                    </div>

                    <div class="calendar-grid">
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day">
                            <span class="day-number">1</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">2</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">3</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">4</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">5</span>
                        </div>

                        <div class="calendar-day">
                            <span class="day-number">6</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">7</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">8</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">9</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">10</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">11</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">12</span>
                        </div>

                        <div class="calendar-day">
                            <span class="day-number">13</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">14</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">15</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">16</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">17</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">18</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">19</span>
                        </div>

                        <div class="calendar-day today">
                            <span class="day-number">27</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">28</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">29</span>
                        </div>
                        <div class="calendar-day">
                            <span class="day-number">30</span>
                        </div>
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day empty"></div>
                    </div>
                </div>
            </div>
        </x-ui.card>
    </x-ui.modal>
</div>
