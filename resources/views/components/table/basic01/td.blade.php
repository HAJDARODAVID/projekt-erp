<td class="{{ $class }}" style="{{ $style }}">
    @if($numberFormat)
        {{ number_format($value, 2, ',', '.') }}@if ($currencySymbol){{ $currencySymbol }} @endif
    @else
        {{ $value }}
    @endif
</td>