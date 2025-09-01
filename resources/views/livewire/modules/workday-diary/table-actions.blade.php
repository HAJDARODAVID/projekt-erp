<div class="d-flex gap-1">
    <x-ui.btn type="pri.sm" icon="pen" />
    <x-ui.btn type="pri.sm" icon="people" />
    <x-v-divider />
    @livewire('modules.workday-diary.delete-work-diary-btn', ['row' => $row], key($row->id.now()))
</div>
