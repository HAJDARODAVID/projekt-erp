<div class="">
    @isset($livewire)
        @livewire($livewire, ['row' => $row], key("".now()))
    @endisset
</div>