<div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">TROŠKOVI</th>
                @foreach ($months as $month)
                    <th scope="col">{{ $month }}</th>   
                @endforeach
                <th scope="col">2024</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $provider => $data)
                <tr>
                    <td>{{ $provider }}</td>
                    @foreach ($data as $month => $amount)
                        <td>
                            @if ($month>12 || $provider=='overall')
                                <b>
                            @endif
                                {{ number_format((float)$amount, 2, ',', '.') }}€
                            @if ($month>12 || $provider=='overall')
                                </b>
                            @endif
                            
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
