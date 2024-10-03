<div class="" style="height: 800px">
    {{-- <div class="row mb-3">
        <x-dashboard.card-component livewire='test' />
        <x-dashboard.card-component />

    </div>
    <div class="row mb-3">
        <x-dashboard.card-component livewire='test' />
    </div> --}}

    @foreach ($config as $row)
        @php
            $height = NULL;
            $height_row = isset($row['height']) ? $row['height'] : NULL;
        @endphp
        <div class="row">
            @foreach ($row['col'] as $col)
                @php
                   $height = isset($col['height']) ? $col['height'] : $height_row;
                   $lw_comp = isset($col['livewire']) ? $col['livewire'] : NULL; 
                @endphp
                <x-dashboard.card-component 
                    :title="$col['title']"
                    :livewire="$lw_comp"
                    :height='$height'
                />   
            @endforeach
            
        </div>
    @endforeach
</div>
