<div>
    <x-modal :show='$show' :alert='TRUE' aType='{{ $type }}' size='{{ $size }}' :blur='TRUE' position='center'>
        <x-slot name='mainTitle'>{{ $title }}</x-slot>
        {{-- BODY CONTEND --}}
        <?php echo $message ?>
        <x-slot name='footerItems'>
            <button class='btn btn-@if ($type){{$type}} @else{{ __('dark') }} @endif btn-sm' wire:click='closeAlert()'>Ok</button>
        </x-slot>
    </x-modal>
</div>