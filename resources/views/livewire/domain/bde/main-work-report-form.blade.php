<div>
    <x-cards.card>
        <x-slot:title>evidencija radnog dana</x-slot:title>
        <x-slot:headerBtn>
            <button>x</button>
        </x-slot:title>

        <h1 class="h6 "><b>Datum</b></h1>
        <input type="date" class="form-control" wire:model.change='wdr.date'>
        <hr>
        <h1 class="h6 "><b>Gradilište</b></h1>
        <select class="form-select form-select-sm mb-2 @if (!$selectedJobSite) is-invalid @endif" style="display:inline" wire:model.live="selectedJobSite">
            <option value="0" selected>Odaberi gradilište</option>
            @foreach($jobSites as $jobSite)
                <option value="{{$jobSite->id}}">{{$jobSite->name}}</option>
            @endforeach
        </select><br>
    </x-cards.card>
</div>
