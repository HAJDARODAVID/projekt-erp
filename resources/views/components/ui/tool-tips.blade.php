<div 
    x-data="{ showTooltip: false }" 
    class="d-inline-block position-relative" 
    @mouseenter="showTooltip = true" 
    @mouseleave="showTooltip = false"
>
    <div style="font-size: 10px; cursor: pointer; display: inline-block">
        [?]
    </div>

    <div  
        id="tool-tip-message-box"
        class="tool-tip" 
        x-show="showTooltip" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div style="width: 230px; padding: 10px">
            {{ $message }}
        </div>
    </div>
</div>