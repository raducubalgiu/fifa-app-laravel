<x-home-master>
    @section('content')
    <div class="table-list">
        <div class="container">
            <div class="wrapper">
                <div class="card shadow mt-4">
                    <div class="table-list-ranking">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{$championship->championship_no_of_room}}</h6>
                        </div>

                        <div class="card-body">
                            <h6 class="ranking-date mb-4 mt-2"><strong>Data: {{$championship->created_at->format('d-m-Y')}}</strong></h6>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col text-center">Jucator</th>
                                        <th scope="col text-center">M</th>
                                        <th scope="col text-center">V</th>
                                        <th scope="col text-center">E</th>
                                        <th scope="col text-center">I</th>
                                        <th scope="col text-center">G</th>
                                        <th scope="col text-center">P</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($results as $result)
                                        <tr>
                                            <td>{{$result->player_username}}</td>
                                            <td>{{$result->matches_number}}</td>
                                            <td>{{$result->player_victory}}</td>
                                            <td>{{$result->player_draw}}</td>
                                            <td>{{$result->player_lose}}</td>
                                            <td>{{$result->player_goals - $result->goal_received}}</td>
                                            <td>{{$result->player_points}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-home-master>