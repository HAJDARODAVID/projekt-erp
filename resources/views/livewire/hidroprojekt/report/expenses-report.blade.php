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
    </table>
</div>
