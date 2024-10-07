<div>
    <div class="list-group">
        @foreach ($items as $item)
            @livewire('hidroProjekt.dashboard.components.to-do-list-item',[
                'item' => $item,
            ])
        @endforeach
    </div>
</div>
