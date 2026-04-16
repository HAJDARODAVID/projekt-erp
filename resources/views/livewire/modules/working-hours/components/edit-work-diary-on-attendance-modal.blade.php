<div class="">
    @if($displayIcon)
        @if ($icon)
            {!! $icon !!}
        @else
            <i class="bi bi-plus-square" style="cursor: pointer;padding: 0px 4px" wire:click='openModal'></i>
        @endif
    @endif
    
    <x-ui.modal :modalStatus=$modalStatus  size="l">
        <x-slot:title>{{strtoupper(translator('Attendance work diary')) }}</x-slot:title>
        <x-ui.card :noBodyPadding=TRUE loading="diaryInfo" :border=FALSE>
            <div class="d-flex gap-2">
                <x-ui.select 
                :options=$allWorkDiariesOptions 
                class="form-select-sm" 
                />
                <x-ui.btn type="dan.sm" icon="trash"  />
            </div>
        </x-ui.card>
    </x-ui.modal>
</div>