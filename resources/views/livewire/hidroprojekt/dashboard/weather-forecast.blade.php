<div>
    <table class="table">
        <tbody>
            <tr>
                <td></td>
                <td>5:00</td>
                <td>8:00</td>
                <td>11:00</td>
                <td>14:00</td>
                <td>17:00</td>
            </tr>
            @foreach ($weatherData as $day => $items)
                <tr>
                    <td>{{ $day }}</td>
                    @foreach ($items as $hour)   
                        <td>
                            <x-dashboard.weather-card :hour="$hour" />
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
