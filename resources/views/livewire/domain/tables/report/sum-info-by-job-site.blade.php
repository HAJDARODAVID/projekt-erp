<div class="px-4 pt-3">
    <input type="text" wire:model.blur='search'>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            @foreach (json_decode($columns) as $column)
                <th>{{ $column->title }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $id => $row)
                <tr>
                    @foreach (json_decode($columns) as $column)
                        <x-table.basic01.td value='{{ $row[$column->from] }}' :param="$column->style" />
                    @endforeach
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>