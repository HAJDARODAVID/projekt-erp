<div>
    
    @if(!is_null($hour))
        <img src="https://meteo.hr/assets/images/icons/{{ $hour['simbol'] }}.svg" alt="" width="30" height="30">
        {{ $hour['t_2m'] }}°C
    @endif
    
</div>