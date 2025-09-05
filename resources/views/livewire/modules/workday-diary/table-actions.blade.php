<div class="d-flex gap-1">
    @livewire('modules.workday-diary.edit-diary-modal', ['row' => $row], key('edit'.$row->id.now()))
    @livewire('modules.workday-diary.edit-attendance-modal', ['row' => $row], key('edit-attendance'.$row->id.now()))
    
    <x-v-divider />
    {{-- TODO: Can not delete if material is consumed --}}
    @livewire('modules.workday-diary.delete-work-diary-btn', ['row' => $row], key($row->id.now()))
</div>
