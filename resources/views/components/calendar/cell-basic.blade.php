<div @if(isset($properties['cellData'])) x-data="{ isControlPressed: '{{ $properties['cellData']['date']->format('Y-m-d') }}' }" @click="clickHandler($event, isControlPressed)" @endif >
    <div class="shadow {{ ClassMerger::merge($class) }} @if($selected) calendar-cell-is-selected @else border @endif p-2 " style="width: {{ $w }}px; height: {{ $h }}px" id="@if(isset($properties['cellData'])){{ $properties['cellData']['date']->format('Y-m-d')}}@endif">
        @if(isset($properties['day']))
            <div class="d-flex justify-content-center px-2">
                @isset($properties['day']) <b>{{  mb_strtoupper($properties['day'], 'UTF-8') }}</b> @endisset
            </div>
        @else
            <div class="d-flex justify-content-between px-2">
                <div class="" style="color: rgb(69, 89, 114)">
                    @isset($properties['cellData']['date']) 
                        <b>{{ $properties['cellData']['date']->format('d') }}</b> 
                    @endisset 
                </div>
            </div>
            <hr class="m-0 p-0">
            <div class="mx-3">
                <div class="d-flex h4 mt-2">
                    @if ($attInfo)
                        <i class="bi bi-clock"></i> <span>&nbsp; :&nbsp; </span> {{ $attInfo }}
                    @endif
                </div>
            </div>
        @endif
    </div>
    <script>
        function clickHandler(event,date) {
            if (event.ctrlKey) {
                Livewire.dispatch('add-to-selected-dates-array',[date,2]);         
            }else{
                Livewire.dispatch('add-to-selected-dates-array',[date,1]); 
            }
        }
    </script>
</div>