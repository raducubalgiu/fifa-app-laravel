<x-admin-master>
    @section('content')
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Jucator</th>
            <th>Echipa</th>
            <th>M</th>
            <th>V</th>
            <th>E</th>
            <th>I</th>
            <th>G</th>
            <th>P</th>
        </tr>
    </thead>

    <tbody>
        @foreach($result as $result)
        <tr>
            <td>{{$result->player_firstname}} {{$result->player_lastname}}</td>
            <td>{{$result->player_team}}</td>
            <td>{{$result->matches_number}}</td>
            <td>{{$result->player_victory}}</td>
            <td>{{$result->player_draw}}</td>
            <td>{{$result->player_lose}}</td>
            <td>{{$result->player_goals}} : {{$result->goal_received}}</td>
            <td>{{$result->player_points}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endsection
</x-admin-master>
