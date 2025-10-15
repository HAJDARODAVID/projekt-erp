@extends('layouts.app-admin')

@section('content')
<div class="mt-3">
    @if ($mainTitle) 
        <x-ui.module.header :title=$mainTitle :tabLinks=$tabLinks>
            {{-- <x-slot:actionsBtn> @livewire('modules.workday-diary.create-new-diary-modal') </x-slot> --}}
        </x-ui.module-header>
    @endif

    
    @if ($livewire)
        @livewire("modules.$module.$component")
    @endif
    
</div>
@endsection