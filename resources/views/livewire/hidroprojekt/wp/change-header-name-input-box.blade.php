<div>
    <div id="constSiteHeaderName" style="cursor: pointer;" onclick="enableHeaderNameChange()">
        <span class="h3" >{{ $headerName }}</span>
    </div>
    <div style="display: none; width: 500px" id="constSiteHeaderNameChange" style="cursor: pointer;">
        <input class="form-control form-control-lg" type="text" wire:model.blur='headerName'>
    </div>

</div>
