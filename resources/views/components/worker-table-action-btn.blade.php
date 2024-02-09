<div class="d-flex flex-row">
    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deleteUser_{{ $row->id }}').submit();" >X</button>
    &nbsp;
    <form action="{{ route('hp_disableWorker', $row->id) }}" method="post" id="deleteUser_{{ $row->id }}">
        @csrf
        @method('PUT') 
    </form>
    @livewire('hidroprojekt.hr.create-new-user-from-worker-btn', [
        'worker' => $row,
    ], key($row->id))
</div>