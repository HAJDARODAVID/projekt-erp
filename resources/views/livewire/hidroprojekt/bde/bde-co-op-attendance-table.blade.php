<div>
    @foreach ($attendance as $groupName => $group)
        <b>{{ $groupName }}</b>
        <table class="table">
            <thead>
                <tr>
                    <td><b>Ime</b></td>
                    <td><b>Sati</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $worker)
                    <tr>
                        <td>{{ $worker['firstName'] }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
    @endforeach
</div>
