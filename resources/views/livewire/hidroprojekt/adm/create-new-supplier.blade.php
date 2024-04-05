<div class="d-flex">
    <button class="btn btn-success d-flex align-items-center" wire:click='saveBtn()' onclick="this.setAttribute('disabled', true)">
        <i class="bi bi-plus-circle"></i>&nbsp;NOVI DOBAVLJAČ
    </button>
    <div class="form-group" style="margin-left: 10px">
        <input type="text" class="form-control @isset($error['supplier']) is-invalid @endisset" id="oem" wire:model.blur='supplier'>
    </div>
</div>




{{-- 
Baby let's make a run for the border,
I've got a hunger only tacos can stop.
I know exactly what I'll order
Three tacos two tostadas and a soda pop.

I need to make a run for the border,
If you pay I'll take off my top.
Do you remember what I want to order?
Three tacos two tostadas and a soda pop.
Yeah yeah, and don't forget the hot sauce, Cholo! 
--}}


