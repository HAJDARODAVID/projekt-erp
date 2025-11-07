<div class="d-flex gap-1">
     <x-ui.btn type="pri.sm" icon="pen" wClickMethod="" />
     @livewire('modules.employees.components.create-app-user-from-worker',['rowData'=> $row], key('create-user'.$row->id.now()))
     <x-v-divider />
     @livewire('modules.employees.components.deactivate-worker',['rowData'=> $row], key('deactivate-worker'.$row->id.now()))
</div>
