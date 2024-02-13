<div style="display: inline">
    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deactivateCar_{{ $row->id }}').submit();">X</button>
    <form action="{{ route('hp_deactivateCar', $row->id) }}" method="post" id="deactivateCar_{{ $row->id }}">
        @csrf
        @method('PUT')      
    </form>
</div>