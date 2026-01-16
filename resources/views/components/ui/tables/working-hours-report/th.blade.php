<th  {{ $attributes->merge(['style' => $style, 'class' => $class]) }} wire:click='{{ $lwAction }}({{ $lwActionAtt }})'>
    {{ $slot }}
</th>