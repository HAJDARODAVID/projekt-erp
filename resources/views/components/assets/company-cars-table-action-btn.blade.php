<div style="display: inline">
    <a href="{{ route('hp_showCompanyCar', $row->car_plates) }}" class="btn btn-primary btn-sm">PRIKAZ</a>
    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deleteUser_{{ $row->id }}').submit();">X</button>
    <form action="{{ route('hp_deleteWorker', $row->id) }}" method="post" id="deleteUser_{{ $row->id }}">
        @csrf
        @method('DELETE')      
    </form>
</div>