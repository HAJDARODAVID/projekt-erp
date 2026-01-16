<x-ui.modal title='Attendance / absence' :modalStatus=$modalStatus >
    <x-slot:subtitle>{{ translator('Date') }}: {{ date('Y-m-d', $date) }}</x-slot:subtitle>
    <x-ui.card :noBodyPadding=TRUE loading="createNewDiary" :border=FALSE>
        <div class="d-flex justify-content-center gap-3">
            @foreach ($absenceType as $typeCode => $typeData)
                <x-ui.btn type="dar.lg" text="{{ translator($typeData['short-text']) }}" wClickMethod="applyAbsenceAction" wClickParam="{{ $typeCode }}" />
            @endforeach
        </div>
        
    </x-ui.card>
</x-ui.modal>