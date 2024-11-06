<div>   
    <select class="form-control form-control-sm" style="width: 90px">
        @foreach ($statuses as $statusKey => $status)
            <option value="{{ $statusKey }}">{{ $status }}</option>
        @endforeach
    </select>
</div>
