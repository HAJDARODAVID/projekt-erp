<div class="mx-2" style="height: 800px">
    @foreach ($config as $row)
        @php
            $height = NULL;
            $height_row = isset($row['height']) ? $row['height'] : NULL;
        @endphp
        <div class="row gap-2">
            @foreach ($row['col'] as $col)
                @php
                   $height = isset($col['height']) ? $col['height'] : $height_row;
                   $lw_comp = isset($col['comp_name']) ? $col['comp_name'] : NULL; 
                   $center = isset($col['center']) ? $col['center'] : NULL; 
                   $btn = isset($col['btn_comp']) ? $col['btn_comp'] : NULL; 
                @endphp
                <x-dashboard.card-component 
                    :title="$col['title']"
                    :livewire="$lw_comp"
                    :height='$height'
                    :center='$center'
                    :btn='$btn'
                />   
            @endforeach
        </div>
    @endforeach
</div>
