<div>
    <h1 class="h6"><b>Gradilište</b></h1>
    <select class="form-select form-select-sm mb-2" style="display:inline" wire:model.live="selectedConstructionSite">
        <option value="0" selected>Odaberi gradilište</option>
        @foreach($constructionSites as $conSites)
            <option value="{{$conSites->id}}">{{$conSites->name}}</option>
        @endforeach
    </select><br>

    {{ __('Adresa: ') }} 
    {{-- <a href="https://www.google.com/maps/place/{{$address->street . ' ' . $address->town}}">{{$address->street . ' ' . $address->town}}</a> --}}
    <hr>
</div>
