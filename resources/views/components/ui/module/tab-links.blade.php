<ul class="nav nav-tabs">
    @foreach ($routes as $routeName => $title)
        <x-ui.module.tab-link-item :routeName=$routeName :title=$title :specialIndexIcon=$specialIndexIcon />
    @endforeach
</ul>