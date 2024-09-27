
<div class="col mx-2 rounded shadow px-0 border" style="background-color: {{ $bgColor }}" id="{{ $cardId }}">
    <div class="d-flex align-items-center rounded-top shadow" style="background-color: {{ $headerColor }};height:40px">
            <div class="h7 px-4" style="color: rgb(102, 121, 146)">
                <b>{{ strtoupper('Stanje materijala') }}</b>
            </div>
    </div>
    <div id="{{ $cardId }}_body">
        <div style="overflow: visible;" >{{ $slot }}</div>
               
    </div>
    <script>setDashBoardCardBodyHeight("{{ $cardId }}")</script>
</div>
